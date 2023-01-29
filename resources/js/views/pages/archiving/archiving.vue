<script>
import Layout from "../../layouts/main";
import PageHeader from "../../../components/Page-header";
import adminApi from "../../../api/adminAxios";
import outerAxios from "../../../api/outerAxios";
import { required } from "vuelidate/lib/validators";
import Swal from "sweetalert2";
import ErrorMessage from "../../../components/widgets/errorMessage";
import loader from "../../../components/loader";
import { dynamicSortString } from "../../../helper/tableSort";
import Multiselect from "vue-multiselect";
import { formatDateTime } from "../../../helper/startDate";
import translation from "../../../helper/translation-mixin";
import DatePicker from "vue2-datepicker";
import rootData from "./root.json";
import TreeBrowser from "../../../components/arch-screen/tree";
import Files from "../../../components/arch-screen/files.vue";
import Details from "../../../components/arch-screen/details.vue";
import VueHtml2pdf from "vue-html2pdf";

/**
 * Advanced Table component
 */
export default {
  page: {
    title: "Archiving",
    meta: [{ name: "description", content: "Archiving" }],
  },
  mixins: [translation],
  components: {
    Layout,
    DatePicker,
    PageHeader,
    ErrorMessage,
    loader,
    Multiselect,
    TreeBrowser,
    Files,
    Details,
    VueHtml2pdf,
  },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      if (vm.$store.state.auth.work_flow_trees.includes("archiving-e")) {
        Swal.fire({
          icon: "error",
          title: `${vm.$t("general.Error")}`,
          text: `${vm.$t("general.ModuleExpired")}`,
        });
        return vm.$router.push({ name: "home" });
      }

      if (
        vm.$store.state.auth.work_flow_trees.includes("archiving screen") ||
        vm.$store.state.auth.work_flow_trees.includes("archiving")
          || vm.$store.state.auth.user.type == 'super_admin'
      ) {
        return true;
      } else {
        return vm.$router.push({ name: "home" });
      }
    });
  },
  data() {
    return {
      printLoading: true,
      printObj: {
        id: "printDepartment",
      },
      images: [],
      media: {},
      saveImageName: [],
      showPhoto: "/images/img-1.png",
      root: [],
      per_page: 6,
      search: "",
      debounce: {},
      archivesPagination: {},
      archives: [],
      documentTypes: [],
      documentStatuses: [],
      enabled3: false,
      isLoader: false,
      currentNode: null,
      archive_id: null,
      fileFields: [],
      fileImages: [],
      secondLevelNodes: [],
      fields: [],
      create: {
        timestamp: null,
        job_file_number: null,
        media: [],
        custom_timestamp: null,
      },
      edit: {
        job_file_number: null,
        document_type_id: null,
        status_id: null,
        description: null,
        timestamp: "",
        custom_timestamp: null,
        old_media: [],
      },
      archiveFiles: [],
      nodeFields: [],
      setting: {
        job_file_number: true,
        document_type_id: true,
        status_id: true,
        timestamp: true,
      },
      filterSetting: [],
      searchCurrentNodeId: null,
      errors: {},
      lockups: [],
      isCheckAll: false,
      checkAll: [],
      is_disabled: false,
      current_page: 1,
      company_id: 48,
      Tooltip: "",
      mouseEnter: null,
      isActiveFile: false,
      isSearch: false,
    };
  },
  validations: {
    create: { media: {} },
    edit: { media: {} },
    nodeFields: {
      $each: {
        value: { required },
      },
    },
  },
  watch: {
    /**
     * watch per_page
     */
    per_page(after, befour) {
      this.getData();
    },
    /**
     * watch search
     */
    search(after, befour) {
      clearTimeout(this.debounce);
      this.debounce = setTimeout(() => {
        this.getData();
        this.isSearch = !this.isSearch;
      }, 400);
    },
    /**
     * watch check All table
     */
    isCheckAll(after, befour) {
      if (after) {
        this.archiveFiles.forEach((el) => {
          if (!this.checkAll.includes(el.id)) {
            this.checkAll.push(el.id);
          }
        });
      } else {
        this.checkAll = [];
      }
    },
  },
  async mounted() {
    this.company_id = this.$store.getters["auth/company_id"];
    // await this.getData();
    this.getTree();
    this.getSecondLevelNodes();
  },
  methods: {
    print() {
      window.print();
    },
    getFields(id) {
      this.isLoader = true;
      adminApi
        .get(`/arch-doc-type/${id}`)
        .then((res) => {
          this.fields = res.data.doc_type_field;
          this.isLoader = false;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
          this.isLoader = false;

        })
        .finally(() => {});
    },
    showFileModal(file) {
      this.fileFields = file.data_type_value;
      this.fileImages = file.media ? file.media : [];
      this.$bvModal.show("show-file");
    },
    showModal(node) {
      this.currentNode = node;
      node.doc_type_field.sort((a, b) => (a.field_order > b.field_order ? 1 : -1));
      this.nodeFields = [...node.doc_type_field].map((field) => {
        // if(field.doc_field_id.data_type.name_e == 'Lookup (table)'){
        // this.getLookup()
        // }
        return {
          ...field,
          value: "",
        };
      });
      console.log(this.nodeFields);

      this.$bvModal.show("create");
    },
    async getLookup(table, column) {
      await adminApi
        .get(`/document-field/column-data/${table}/${column}`)
        .then((res) => {
          let l = res.data;
          this.lockups = l.data;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        })
        .finally(() => {
          this.isLoader = false;
        });
    },
    nodeWasClicked(result) {
      this.currentNode = result;
      this.filterSetting = [this.currentNode.id];
      this.getData();
      this.isActiveFile = !this.isActiveFile;
      this.$store.commit("archiving/archiveFileEmity");
      this.$store.commit("archiving/objectActiveEmity");
    },
    timestamp(e) {
      if (e) {
        this.create.timestamp = formatDateTime(e);
        this.edit.timestamp = formatDateTime(e);
      } else {
        this.create.timestamp = null;
        this.edit.timestamp = null;
      }
    },
    async getTree() {
      this.isLoader = true;
      await adminApi
        .get(`/arch-doc-type/tree`)
        .then((res) => {
          this.root = res.data.data;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        })
        .finally(() => {
          this.isLoader = false;
        });
    },
    async getPdf(id) {
      if (!id) return;
      await adminApi
        .get(`/arch-archive-files/pdf/${id}`)
        .then((res) => {})
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        });
    },
    /**
     *  get Data archives
     */
    async getData(page = 1) {
      this.isLoader = true;
      await adminApi
        .get(
          `/arch-archive-files?page=${page}&per_page=${this.per_page}&search=${this.search}&arch_doc_type_id=${this.filterSetting}`
        )
        .then((res) => {
          let l = res.data;
          this.archiveFiles = l.data;
          this.archivesPagination = l.pagination;
          this.current_page = l.pagination.current_page;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        })
        .finally(() => {
          this.isLoader = false;
        });
    },
    getDataCurrentPage() {
      if (
        this.current_page <= this.archivesPagination.last_page &&
        this.current_page != this.archivesPagination.current_page &&
        this.current_page
      ) {
        this.isLoader = true;
        adminApi
          .get(
            `/arch-archive-files?page=${this.current_page}&per_page=${this.per_page}&search=${this.search}&arch_doc_type_id=${this.filterSetting}`
          )
          .then((res) => {
            let l = res.data;
            this.archiveFiles = l.data;
            this.archivesPagination = l.pagination;
            this.current_page = l.pagination.current_page;
          })
          .catch((err) => {
            Swal.fire({
              icon: "error",
              title: `${this.$t("general.Error")}`,
              text: `${this.$t("general.Thereisanerrorinthesystem")}`,
            });
          })
          .finally(() => {
            this.isLoader = false;
          });
      }
    },

    getSecondLevelNodes() {
      this.isLoader = true;
      adminApi
        .get(`/arch-doc-type/nodes-level-two`)
        .then((res) => {
          this.secondLevelNodes = res.data.data;
          this.secondLevelNodes.forEach((node) => {
            this.filterSetting.push(node.id);
          });
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        })
        .finally(() => {
          this.isLoader = false;
        });
    },

    /**
     *  delete screen button
     */
    deleteScreenButton(id, index) {
      if (Array.isArray(id)) {
        Swal.fire({
          title: `${this.$t("general.Areyousure")}`,
          text: `${this.$t("general.Youwontbeabletoreverthis")}`,
          type: "warning",
          showCancelButton: true,
          confirmButtonText: `${this.$t("general.Yesdeleteit")}`,
          cancelButtonText: `${this.$t("general.Nocancel")}`,
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: false,
        }).then((result) => {
          if (result.value) {
            this.isLoader = true;
            adminApi
              .post(`/arch-archive-files/bulk-delete`, { ids: id })
              .then((res) => {
                this.checkAll = [];
                this.getData();
                Swal.fire({
                  icon: "success",
                  title: `${this.$t("general.Deleted")}`,
                  text: `${this.$t("general.Yourrowhasbeendeleted")}`,
                  showConfirmButton: false,
                  timer: 1500,
                });
              })
              .catch((err) => {
                if (err.response.status == 400) {
                  Swal.fire({
                    icon: "error",
                    title: `${this.$t("general.Error")}`,
                    text: `${this.$t("general.CantDeleteRelation")}`,
                  });
                  this.getData();
                } else {
                  Swal.fire({
                    icon: "error",
                    title: `${this.$t("general.Error")}`,
                    text: `${this.$t("general.Thereisanerrorinthesystem")}`,
                  });
                }
              })
              .finally(() => {
                this.isLoader = false;
              });
          }
        });
      } else {
        Swal.fire({
          title: `${this.$t("general.Areyousure")}`,
          text: `${this.$t("general.Youwontbeabletoreverthis")}`,
          type: "warning",
          showCancelButton: true,
          confirmButtonText: `${this.$t("general.Yesdeleteit")}`,
          cancelButtonText: `${this.$t("general.Nocancel")}`,
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: false,
        }).then((result) => {
          if (result.value) {
            this.isLoader = true;

            adminApi
              .delete(`/arch-archive-files/${id}`)
              .then((res) => {
                this.checkAll = [];
                this.getData();
                Swal.fire({
                  icon: "success",
                  title: `${this.$t("general.Deleted")}`,
                  text: `${this.$t("general.Yourrowhasbeendeleted")}`,
                  showConfirmButton: false,
                  timer: 1500,
                });
              })

              .catch((err) => {
                if (err.response.status == 400) {
                  Swal.fire({
                    icon: "error",
                    title: `${this.$t("general.Error")}`,
                    text: `${this.$t("general.CantDeleteRelation")}`,
                  });
                } else {
                  Swal.fire({
                    icon: "error",
                    title: `${this.$t("general.Error")}`,
                    text: `${this.$t("general.Thereisanerrorinthesystem")}`,
                  });
                }
              })
              .finally(() => {
                this.isLoader = false;
              });
          }
        });
      }
    },
    /**
     *  reset Modal (create)
     */
    async resetModalHidden() {
      await this.getTree();
      await this.getPdf(this.archive_id);
      await this.getData();
      this.create = {
        job_file_number: null,
        document_type_id: null,
        status_id: null,
        description: null,
        timestamp: "",
        custom_timestamp: null,
        media: null,
      };
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.images = [];
      this.errors = {};
      this.archive_id = null;
    },
    /**
     *  hidden Modal (create)
     */
    async resetModal() {
      this.create = {
        data_type_value: null,
        data_type_id: null,
        media: [],
      };
      this.showPhoto = "/images/img-1.png";

      this.is_disabled = false;
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.media = {};
      this.images = [];

      this.errors = {};
    },
    /**
     *  create screen
     */
    resetForm() {
      this.create = {
        data_type_value: null,
        data_type_id: null,
        media: [],
      };
      this.is_disabled = false;
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.media = {};
      this.images = [];
    },
    AddSubmit() {
      this.errors = {};
      this.is_disabled = false;
      let currentNode = this.currentNode;
      let dataTypeValue = [];
      this.nodeFields.forEach((field) => {
        dataTypeValue.push({
          value: field.value,
          name_e: field.doc_field_id.name_e,
          name: field.doc_field_id.name,
          is_reference: field.doc_field_id.is_reference,
        });
      });
      this.$v.nodeFields.$touch();
      let check = false;
      this.nodeFields.forEach((field, index) => {
        if (field.is_required == 1 && this.$v.nodeFields.$each[index].value.$error) {
          return (check = true);
        }
      });
      if (check) {
        return;
      }
      this.isLoader = true;
      adminApi
        .post(`/arch-archive-files`, {
          arch_doc_type_id: currentNode.id,
          data_type_value: dataTypeValue,
        })
        .then((res) => {
          this.archive_id = res.data.data.id;
          this.is_disabled = true;
          setTimeout(() => {
            Swal.fire({
              icon: "success",
              text: `${this.$t("general.Addedsuccessfully")}`,
              showConfirmButton: false,
              timer: 1500,
            });
          }, 500);
        })
        .catch((err) => {
          if (err.response.data) {
            this.errors = err.response.data.errors;
          } else {
            Swal.fire({
              icon: "error",
              title: `${this.$t("general.Error")}`,
              text: `${this.$t("general.Thereisanerrorinthesystem")}`,
            });
          }
        })
        .finally(() => {
          this.isLoader = false;
        });
    },
    /**
     *  edit screen
     */
    editSubmit(id) {
      this.$v.edit.$touch();
      this.images.forEach((e) => {
        this.edit.old_media.push(e.id);
      });
      if (this.$v.edit.$invalid) {
        return;
      } else {
        this.isLoader = true;
        this.errors = {};
        adminApi
          .post(`/arch-archive-files/${id}`, this.edit)
          .then((res) => {
            this.$bvModal.hide(`modal-edit-${id}`);
            this.getData();
            setTimeout(() => {
              Swal.fire({
                icon: "success",
                text: `${this.$t("general.Editsuccessfully")}`,
                showConfirmButton: false,
                timer: 1500,
              });
            }, 500);
          })
          .catch((err) => {
            if (err.response.data) {
              this.errors = err.response.data.errors;
            } else {
              Swal.fire({
                icon: "error",
                title: `${this.$t("general.Error")}`,
                text: `${this.$t("general.Thereisanerrorinthesystem")}`,
              });
            }
          })
          .finally(() => {
            this.isLoader = false;
          });
      }
    },
    /**
     *  get workflows
     */
    async getDocumentTypes() {
      this.isLoader = true;
      await adminApi
        .get(`/gen-arch-doc-type`)
        .then((res) => {
          this.isLoader = false;
          this.documentTypes = res.data.data;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        });
    },

    async getStatuses() {
      this.isLoader = true;
      await adminApi
        .get(`/arch-doc-status`)
        .then((res) => {
          this.isLoader = false;
          this.documentStatuses = res.data.data;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        });
    },
    /**
     *   show Modal (edit)
     */
    async resetModalEdit(id) {
      let archive = this.archiveFiles.find((e) => id == e.id);
      await this.getDocumentTypes();
      await this.getStatuses();
      this.edit.job_file_number = archive.job_file_number;
      this.edit.document_type_id = archive.document_type_id;
      this.edit.status_id = archive.status_id;
      this.edit.description = archive.description;
      this.edit.custom_timestamp = new Date(archive.custom_timestamp);
      this.edit.timestamp = formatDateTime(archive.timestamp);
      this.images = archive.media ?? [];
      if (this.images && this.images.length > 0) {
        this.showPhoto = this.images[this.images.length - 1].webp;
      } else {
        this.showPhoto = "/images/img-1.png";
      }
      this.errors = {};
    },
    /**
     *  hidden Modal (edit)
     */
    resetModalHiddenEdit(id) {
      this.errors = {};
      this.edit = {
        job_file_number: null,
        document_type_id: null,
        status_id: null,
        description: null,
        timestamp: "",
        custom_timestamp: null,
        old_media: [],
      };
      this.images = [];
    },

    /**
     *  start  dynamicSortString
     */
    sortString(value) {
      return dynamicSortString(value);
    },
    checkRow(id) {
      if (!this.checkAll.includes(id)) {
        this.checkAll.push(id);
      } else {
        let index = this.checkAll.indexOf(id);
        this.checkAll.splice(index, 1);
      }
    },
    formatDate(value) {
      return formatDateOnly(value);
    },
    log(id) {
      if (this.mouseEnter != id) {
        this.Tooltip = "";
        this.mouseEnter = id;
        adminApi
          .get(`/arch-archive-files/logs/${id}`)
          .then((res) => {
            let l = res.data.data;
            l.forEach((e) => {
              this.Tooltip += `Created By: ${e.causer_type}; Event: ${
                e.event
              }; Description: ${e.description} ;Created At: ${this.formatDate(
                e.created_at
              )} \n`;
            });
            $(`#tooltip-${id}`).tooltip();
          })
          .catch((err) => {
            Swal.fire({
              icon: "error",
              title: `${this.$t("general.Error")}`,
              text: `${this.$t("general.Thereisanerrorinthesystem")}`,
            });
          });
      }
    },
    /**
     *  start Image ceate
     */
    changePhoto() {
      document.getElementById("uploadImageCreate").click();
    },
    changePhotoEdit() {
      document.getElementById("uploadImageEdit").click();
    },
    onImageChanged(e) {
      const file = e.target.files[0];
      this.addImage(file);
    },
    addImage(file) {
      this.media = file; //upload
      if (file) {
        this.idDelete = null;
        let is_media = this.images.find(
          (e) => e.name == file.name.slice(0, file.name.indexOf("."))
        );
        this.idDelete = is_media ? is_media.id : null;
        if (!this.idDelete) {
          this.isLoader = true;
          let formDate = new FormData();
          formDate.append("media[0]", this.media);
          adminApi
            .post(`/media`, formDate)
            .then((res) => {
              let old_media = [];
              this.images.forEach((e) => old_media.push(e.id));
              let new_media = [];
              res.data.data.forEach((e) => new_media.push(e.id));

              adminApi
                .put(`/arch-archive-files/${this.archive_id}`, {
                  old_media,
                  media: new_media,
                })
                .then((res) => {
                  this.images = res.data.data.media ?? [];
                  if (this.images && this.images.length > 0) {
                    this.showPhoto = this.images[this.images.length - 1].webp;
                  } else {
                    this.showPhoto = "/images/img-1.png";
                  }
                  // this.getData();
                })
                .catch((err) => {
                  Swal.fire({
                    icon: "error",
                    title: `${this.$t("general.Error")}`,
                    text: `${this.$t("general.Thereisanerrorinthesystem")}`,
                  });
                });
            })
            .catch((err) => {
              if (err.response.data) {
                this.errors = err.response.data.errors;
              } else {
                Swal.fire({
                  icon: "error",
                  title: `${this.$t("general.Error")}`,
                  text: `${this.$t("general.Thereisanerrorinthesystem")}`,
                });
              }
            })
            .finally(() => {
              this.isLoader = false;
            });
        } else {
          Swal.fire({
            title: `${this.$t("general.Thisfilehasalreadybeenuploaded")}`,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: `${this.$t("general.Replace")}`,
            cancelButtonText: `${this.$t("general.Nocancel")}`,
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ml-2 mt-2",
            buttonsStyling: false,
          }).then((result) => {
            if (result.value) {
              this.isLoader = true;
              let formDate = new FormData();
              formDate.append("media[0]", this.media);
              adminApi
                .post(`/media`, formDate)
                .then((res) => {
                  let old_media = [];
                  this.images.forEach((e) => old_media.push(e.id));
                  old_media.splice(old_media.indexOf(this.idDelete), 1);
                  let new_media = [];
                  res.data.data.forEach((e) => new_media.push(e.id));

                  adminApi
                    .put(`/arch-archive-files/${this.country_id}`, {
                      old_media,
                      media: new_media,
                    })
                    .then((res) => {
                      this.images = res.data.data.media ?? [];
                      if (this.images && this.images.length > 0) {
                        this.showPhoto = this.images[this.images.length - 1].webp;
                      } else {
                        this.showPhoto = "/images/img-1.png";
                      }
                      this.getData();
                    })
                    .catch((err) => {
                      Swal.fire({
                        icon: "error",
                        title: `${this.$t("general.Error")}`,
                        text: `${this.$t("general.Thereisanerrorinthesystem")}`,
                      });
                    });
                })
                .catch((err) => {
                  if (err.response.data) {
                    this.errors = err.response.data.errors;
                  } else {
                    Swal.fire({
                      icon: "error",
                      title: `${this.$t("general.Error")}`,
                      text: `${this.$t("general.Thereisanerrorinthesystem")}`,
                    });
                  }
                })
                .finally(() => {
                  this.isLoader = false;
                });
            }
          });
        }
      }
    },
    deleteImageCreate(id, index) {
      let old_media = [];
      this.images.forEach((e) => {
        if (e.id != id) {
          old_media.push(e.id);
        }
      });
      adminApi
        .put(`/arch-archive-files/${this.archive_id}`, { old_media })
        .then((res) => {
          this.images = res.data.data.media ?? [];
          if (this.images && this.images.length > 0) {
            this.showPhoto = this.images[this.images.length - 1].webp;
          } else {
            this.showPhoto = "/images/img-1.png";
          }
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        });
    },
    /**
     *  end Image ceate
     */
    /**
     *  start pdf
     */
    generateReport() {
      this.$refs.html2Pdf.generatePdf();
    },
    async deleteFileComponent(id) {
      let file = this.archiveFiles.find((e) => (e.id = id));
      this.$store.commit("archiving/objectActiveEmity");
      this.$store.commit("archiving/archiveFileUpdate", file);
      await this.getTree();
      await this.getData();
    },
  },
};
</script>
<template>
  <Layout>
    <PageHeader />
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row justify-content-between align-items-center mb-2">
              <h4 class="header-title">{{ $t("general.archivingTable") }}</h4>
              <div class="d-flex col-xs-10 col-md-9 col-lg-7" style="font-weight: 500">
                <div class="d-flex">
                  <!-- Basic dropdown -->
                  <b-dropdown
                    variant="primary"
                    :text="$t('general.workspace')"
                    ref="dropdown"
                    class="btn-block setting-search m-2"
                  >
                    <b-form-checkbox
                      v-for="node in secondLevelNodes"
                      :key="node.id"
                      v-model="searchCurrentNodeId"
                      :value="node.id"
                      class="mb-1"
                      @change="getFields"
                    >
                      {{ $i18n.locale == "ar" ? node.name : node.name_e }}
                    </b-form-checkbox>
                  </b-dropdown>
                  <!-- Basic dropdown -->
                  <!-- Basic dropdown -->
                  <b-dropdown
                    variant="primary"
                    :text="$t('general.fields')"
                    ref="dropdown"
                    class="btn-block setting-search m-2"
                  >
                    <b-form-checkbox
                      v-for="field in fields"
                      :key="field.id"
                      v-model="filterSetting"
                      :value="field.id"
                      class="mb-1"
                    >
                      {{ $i18n.locale == "ar" ? field.name : field.name_e }}
                    </b-form-checkbox>
                  </b-dropdown>
                  <!-- Basic dropdown -->
                </div>
                <div class="d-inline-block position-relative m-2" style="width: 77%">
                  <span
                    :class="[
                      'search-custom position-absolute',
                      $i18n.locale == 'ar' ? 'search-custom-ar' : '',
                    ]"
                  >
                    <i class="fe-search"></i>
                  </span>
                  <input
                    class="form-control"
                    style="display: block; width: 93%; padding-top: 3px"
                    type="text"
                    v-model.trim="search"
                    :placeholder="`${$t('general.Search')}...`"
                  />
                </div>
              </div>
            </div>

            <div class="row justify-content-between align-items-center mt-3 mb-2 px-1">
              <div class="col-md-9 d-flex align-items-center mb-1 mb-xl-0">
                <!--                <b-button-->
                <!--                  v-b-modal.create-->
                <!--                  variant="primary"-->
                <!--                  class="btn-sm mx-1 font-weight-bold"-->
                <!--                >-->
                <!--                  {{ $t("general.Clicktoupload") }}-->
                <!--                  <i class="fas fa-plus"></i>-->
                <!--                </b-button>-->
                <!--                <b-button-->
                <!--                  v-b-modal.create-->
                <!--                  variant="primary"-->
                <!--                  class="btn-sm mx-1 font-weight-bold"-->
                <!--                >-->
                <!--                  {{ $t("general.UploadMany") }}-->
                <!--                  <i class="fas fa-plus"></i>-->
                <!--                </b-button>-->
                <!--                <b-button-->
                <!--                  v-b-modal.create-->
                <!--                  variant="primary"-->
                <!--                  class="btn-sm mx-1 font-weight-bold"-->
                <!--                >-->
                <!--                  {{ $t("general.Workflow") }}-->
                <!--                  <i class="fas fa-plus"></i>-->
                <!--                </b-button>-->
                <!--                <b-button-->
                <!--                  v-b-modal.create-->
                <!--                  variant="primary"-->
                <!--                  class="btn-sm mx-1 font-weight-bold"-->
                <!--                >-->
                <!--                  {{ $t("general.View") }}-->
                <!--                  <i class="fas fa-plus"></i>-->
                <!--                </b-button>-->
                <!--                <b-button-->
                <!--                  v-b-modal.create-->
                <!--                  variant="primary"-->
                <!--                  class="btn-sm mx-1 font-weight-bold"-->
                <!--                >-->
                <!--                  {{ $t("general.ChangeStatus") }}-->
                <!--                  <i class="fas fa-plus"></i>-->
                <!--                </b-button>-->
                <!--                <div class="btn-group">-->
                <!--                  <button-->
                <!--                    type="button"-->
                <!--                    class="btn btn-sm dropdown-toggle dropdown-coustom"-->
                <!--                    data-toggle="dropdown"-->
                <!--                    aria-expanded="false"-->
                <!--                  >-->
                <!--                    {{ $t("general.commands") }}-->
                <!--                    <i class="fas fa-angle-down"></i>-->
                <!--                  </button>-->
                <!--                  <div class="dropdown-menu dropdown-menu-custom">-->
                <!--                    <a class="dropdown-item" href="#">-->
                <!--                      <div-->
                <!--                        class="d-flex justify-content-between align-items-center text-black"-->
                <!--                      >-->
                <!--                        <span>{{ $t("general.print") }}</span>-->
                <!--                      </div>-->
                <!--                    </a>-->
                <!--                    <a class="dropdown-item text-black" href="#">-->
                <!--                      <div-->
                <!--                        class="d-flex justify-content-between align-items-center text-black"-->
                <!--                      >-->
                <!--                        <span>{{ $t("general.send_email") }}</span>-->
                <!--                      </div>-->
                <!--                    </a>-->
                <!--                    <a class="dropdown-item text-black" href="#">-->
                <!--                      <div-->
                <!--                        class="d-flex justify-content-between align-items-center text-black"-->
                <!--                      >-->
                <!--                        <span>{{ $t("general.send_user") }}</span>-->
                <!--                      </div>-->
                <!--                    </a>-->
                <!--                  </div>-->
                <!--                </div>-->
                <!--                <div class="d-inline-flex">-->
                <!--                  <button-->
                <!--                    class="custom-btn-dowonload"-->
                <!--                    @click="$bvModal.show(`modal-edit-${checkAll[0]}`)"-->
                <!--                    v-if="checkAll.length == 1"-->
                <!--                  >-->
                <!--                    <i class="mdi mdi-square-edit-outline"></i>-->
                <!--                  </button>-->
                <!--                  &lt;!&ndash; start mult delete  &ndash;&gt;-->
                <!--                  <button-->
                <!--                    class="custom-btn-dowonload"-->
                <!--                    v-if="checkAll.length > 1"-->
                <!--                    @click.prevent="deleteScreenButton(checkAll)"-->
                <!--                  >-->
                <!--                    <i class="fas fa-trash-alt"></i>-->
                <!--                  </button>-->
                <!--                  &lt;!&ndash; end mult delete  &ndash;&gt;-->
                <!--                  &lt;!&ndash;  start one delete  &ndash;&gt;-->
                <!--                  <button-->
                <!--                    class="custom-btn-dowonload"-->
                <!--                    v-if="checkAll.length == 1"-->
                <!--                    @click.prevent="deleteScreenButton(checkAll[0])"-->
                <!--                  >-->
                <!--                    <i class="fas fa-trash-alt"></i>-->
                <!--                  </button>-->
                <!--                  &lt;!&ndash;  end one delete  &ndash;&gt;-->
                <!--                </div>-->
              </div>
              <div
                class="col-xs-10 col-md-9 col-lg-3 d-flex align-items-center justify-content-end"
              >
                <div>
                  <!-- <b-button class="mx-1 custom-btn-background">
                    {{ $t("general.filter") }}
                    <i class="fas fa-filter"></i>
                  </b-button> -->
                  <!-- start Pagination -->
                  <div class="d-inline-flex align-items-center pagination-custom">
                    <div class="d-inline-block" style="font-size: 15px">
                      {{ archivesPagination.from }}-{{ archivesPagination.to }}
                      /
                      {{ archivesPagination.total }}
                    </div>
                    <div class="d-inline-block">
                      <a
                        href="javascript:void(0)"
                        :style="{
                          'pointer-events':
                            archivesPagination.current_page == 1 ? 'none' : '',
                        }"
                        @click.prevent="getData(archivesPagination.current_page - 1)"
                      >
                        <span>&lt;</span>
                      </a>
                      <input
                        type="text"
                        @keyup.enter="getDataCurrentPage()"
                        v-model="current_page"
                        class="pagination-current-page"
                      />
                      <a
                        href="javascript:void(0)"
                        :style="{
                          'pointer-events':
                            archivesPagination.last_page ==
                            archivesPagination.current_page
                              ? 'none'
                              : '',
                        }"
                        @click.prevent="getData(archivesPagination.current_page + 1)"
                      >
                        <span>&gt;</span>
                      </a>
                    </div>
                  </div>
                  <!-- end Pagination -->
                </div>
              </div>
            </div>

            <!--  create   -->
            <b-modal
              dialog-class="modal-full-width"
              id="create"
              :title="getCompanyKey('archive_create_form')"
              title-class="font-18"
              size="lg"
              body-class="p-4 "
              :hide-footer="true"
              @show="resetModal"
              @hidden="resetModalHidden"
            >
              <form>
                <div class="card">
                  <div class="card-body">
                    <div class="mb-3 d-flex justify-content-end">
                      <b-button
                        variant="success"
                        :disabled="!is_disabled"
                        @click.prevent="resetForm"
                        type="button"
                        :class="['font-weight-bold px-2', is_disabled ? 'mx-2' : '']"
                      >
                        {{ $t("general.AddNewRecord") }}
                      </b-button>
                      <template v-if="!is_disabled">
                        <b-button
                          variant="success"
                          type="submit"
                          class="mx-1"
                          v-if="!isLoader"
                          @click.prevent="AddSubmit"
                        >
                          {{ $t("general.Add") }}
                        </b-button>

                        <b-button variant="success" class="mx-1" disabled v-else>
                          <b-spinner small></b-spinner>
                          <span class="sr-only">{{ $t("login.Loading") }}...</span>
                        </b-button>
                      </template>

                      <b-button
                        variant="danger"
                        type="button"
                        @click.prevent="$bvModal.hide(`create`)"
                      >
                        {{ $t("general.Cancel") }}
                      </b-button>
                    </div>
                  </div>
                  <b-tabs nav-class="nav-tabs nav-bordered">
                    <b-tab :title="$t('general.DataEntry')" active>
                      <div v-if="currentNode" class="row">
                        <div
                          v-for="(field, index) in nodeFields"
                          :key="field.id"
                          class="col-lg-6"
                        >
                          <div
                            v-if="field.doc_field_id.data_type.name_e == 'DATE'"
                            class="form-group"
                          >
                            <label class="control-label">
                              {{
                                $i18n.locale == "ar"
                                  ? field.doc_field_id.name
                                  : field.doc_field_id.name_e
                              }}
                              <span v-if="field.is_required == 1" class="text-danger"
                                >*</span
                              >
                            </label>
                            <date-picker
                              v-model="field.value"
                              type="date"
                              confirm
                            ></date-picker>
                          </div>
                          <div
                            v-else-if="
                              field.doc_field_id.data_type.name_e == 'Lookup (table)'
                            "
                            class="form-group"
                          >
                            <label class="my-1 mr-2">
                              {{
                                $i18n.locale == "ar"
                                  ? field.doc_field_id.name
                                  : field.doc_field_id.name_e
                              }}</label
                            >
                            <span v-if="field.is_required == 1" class="text-danger"
                              >*</span
                            >
                            <multiselect
                              v-model="$v.nodeFields.$each[index].value.$model"
                              :options="lockups.map((type) => type.id)"
                              :custom-label="
                                (opt) =>
                                  $i18n.locale == 'ar'
                                    ? lockups.find((x) => x.id == opt).name
                                    : lockups.find((x) => x.id == opt).name_e
                              "
                              :class="{
                                'is-invalid':
                                  field.is_required == 1 &&
                                  $v.nodeFields.$each[index].value.$error,
                                'is-valid':
                                  field.is_required != 1 ||
                                  !$v.nodeFields.$each[index].value.$invalid,
                              }"
                            >
                            </multiselect>
                          </div>
                          <div v-else class="form-group">
                            <label class="control-label">
                              {{
                                $i18n.locale == "ar"
                                  ? field.doc_field_id.name
                                  : field.doc_field_id.name_e
                              }}
                              <span v-if="field.is_required == 1" class="text-danger"
                                >*</span
                              >
                            </label>
                            <input
                              type="text"
                              class="form-control"
                              data-create="9"
                              step="0.1"
                              @keypress.enter="moveInput('select', 'create', 10)"
                              v-model="$v.nodeFields.$each[index].value.$model"
                              :class="{
                                'is-invalid':
                                  field.is_required == 1 &&
                                  $v.nodeFields.$each[index].value.$error,
                                'is-valid':
                                  field.is_required != 1 ||
                                  !$v.nodeFields.$each[index].value.$invalid,
                              }"
                            />
                          </div>
                        </div>
                      </div>
                    </b-tab>
                    <b-tab :disabled="!archive_id" :title="$t('general.ImageUploads')">
                      <div class="row">
                        <input
                          accept="image/png, image/gif, image/jpeg, image/jpg"
                          type="file"
                          id="uploadImageCreate"
                          @change.prevent="onImageChanged"
                          class="input-file-upload position-absolute"
                          :class="[
                            'd-none',
                            {
                              'is-invalid': $v.create.media.$error || errors.media,
                              'is-valid': !$v.create.media.$invalid && !errors.media,
                            },
                          ]"
                        />
                        <div class="col-md-8 my-1">
                          <!-- file upload -->
                          <div
                            class="row align-content-between"
                            style="width: 100%; height: 100%"
                          >
                            <div class="col-12">
                              <div class="d-flex flex-wrap">
                                <div
                                  :class="[
                                    'dropzone-previews col-4 position-relative mb-2',
                                  ]"
                                  v-for="(photo, index) in images"
                                  :key="photo.id"
                                >
                                  <div
                                    :class="[
                                      'card mb-0 shadow-none border',
                                      images.length - 1 == index ? 'bg-primary' : '',
                                    ]"
                                  >
                                    <div class="p-2">
                                      <div class="row align-items-center">
                                        <div
                                          class="col-auto"
                                          @click="showPhoto = photo.webp"
                                        >
                                          <img
                                            data-dz-thumbnail
                                            :src="photo.webp"
                                            class="avatar-sm rounded bg-light"
                                            @error="src = '/images/img-1.png'"
                                          />
                                        </div>
                                        <div class="col pl-0">
                                          <a
                                            href="javascript:void(0);"
                                            :class="[
                                              'font-weight-bold',
                                              images.length - 1 == index
                                                ? 'text-white'
                                                : 'text-muted',
                                            ]"
                                            data-dz-name
                                          >
                                            {{ photo.name }}
                                          </a>
                                        </div>
                                        <!-- Button -->
                                        <a
                                          href="javascript:void(0);"
                                          :class="[
                                            'btn-danger dropzone-close',
                                            $i18n.locale == 'ar'
                                              ? 'dropzone-close-rtl'
                                              : '',
                                          ]"
                                          data-dz-remove
                                          @click.prevent="
                                            deleteImageCreate(photo.id, index)
                                          "
                                        >
                                          <i class="fe-x"></i>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="footer-image col-12">
                              <b-button
                                @click="changePhoto"
                                variant="success"
                                type="button"
                                class="mx-1 font-weight-bold px-3"
                                v-if="!isLoader"
                              >
                                {{ $t("general.Add") }}
                              </b-button>
                              <b-button variant="success" class="mx-1" disabled v-else>
                                <b-spinner small></b-spinner>
                                <span class="sr-only">{{ $t("login.Loading") }}...</span>
                              </b-button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="show-dropzone">
                            <img
                              :src="showPhoto"
                              class="img-thumbnail"
                              @error="src = '/images/img-1.png'"
                            />
                          </div>
                        </div>
                      </div>
                    </b-tab>
                  </b-tabs>
                </div>
              </form>
            </b-modal>
            <!--show file-->

            <b-modal
              dialog-class="modal-full-width"
              id="show-file"
              :title="$t('general.SHOW_FILE')"
              title-class="font-18"
              size="lg"
              body-class="p-4 "
              :hide-footer="true"
              @hidden="showPhoto = '/images/img-1.png'"
            >
              <form>
                <div class="d-flex justify-content-end">
                  <button
                    type="button"
                    v-print="'#printDepartment'"
                    class="custom-btn-dowonload"
                  >
                    <i class="fe-printer"></i>
                  </button>
                  <a
                    v-if="fileImages.length > 0"
                    class="custom-btn-dowonload"
                    :href="fileImages[fileImages.length - 1].url"
                    download
                  >
                    <i class="fa fa-file-pdf"></i>
                  </a>
                </div>
                <div
                  class="card"
                  id="printDepartment"
                  style="background: none !important"
                >
                  <div class="row">
                    <div
                      v-for="(field, index) in fileFields"
                      :key="index"
                      class="col-lg-6"
                    >
                      <div class="form-group">
                        <label class="control-label">
                          {{ $i18n.locale == "ar" ? field.name : field.name_e }}
                        </label>
                        <input
                          readonly
                          :value="field.value"
                          type="text"
                          class="form-control"
                          data-create="9"
                          step="0.1"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-md-8 my-1">
                      <!-- file upload -->
                      <div
                        class="row align-content-between"
                        style="width: 100%; height: 100%"
                      >
                        <div class="col-12">
                          <div class="d-flex flex-wrap">
                            <div
                              :class="['dropzone-previews col-12 position-relative mb-2']"
                              v-for="(photo, index) in fileImages"
                              :key="photo.id"
                            >
                              <div
                                v-if="photo.mime_type != 'application/pdf'"
                                :class="['card mb-0 shadow-none border']"
                              >
                                <div class="p-2">
                                  <div class="row align-items-center">
                                    <div class="col-auto" @click="showPhoto = photo.webp">
                                      <img
                                        data-dz-thumbnail
                                        :src="photo.webp"
                                        class="avatar-sm rounded bg-light"
                                        @error="src = '/images/img-1.png'"
                                      />
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="single-image col-md-4">
                      <div class="show-dropzone">
                        <img
                          :src="showPhoto"
                          class="img-thumbnail"
                          @error="src = '/images/img-1.png'"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </b-modal>
            <!--  /create   -->

            <div class="row">
              <div class="col-lg-3">
                <div class="references border">
                  <TreeBrowser
                    @onDoubleClicked="showModal"
                    :nodes="root"
                    @onClick="nodeWasClicked"
                  />
                </div>
              </div>
              <div class="col-lg-5">
                <Files
                  @onDoubleClicked="showFileModal"
                  :archiveFiles="archiveFiles"
                  :isActiveFile="isActiveFile"
                  :isSearch="isSearch"
                />
              </div>
              <div class="col-lg-4" v-if="$store.state.archiving.archiveFile.length > 0">
                <Details
                  :currentNode="currentNode"
                  @getDataTree="getData"
                  @pdfPopup="generateReport"
                  @deleteFile="deleteFileComponent"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--      <div>-->
    <!--          <VueHtml2pdf-->
    <!--              :show-layout="false"-->
    <!--              :float-layout="false"-->
    <!--              :enable-download="true"-->
    <!--              :preview-modal="true"-->
    <!--              :paginate-elements-by-height="2400"-->
    <!--              filename="myPDF"-->
    <!--              :pdf-quality="2"-->
    <!--              :manual-pagination="false"-->
    <!--              pdf-format="a4"-->
    <!--              pdf-orientation="landscape"-->
    <!--              pdf-content-width="800px"-->
    <!--              ref="html2Pdf"-->
    <!--          >-->
    <!--              <section slot="pdf-content" id="printDepartment">-->
    <!--                  <div class="row m-0">-->
    <!--                      <div-->
    <!--                          v-for="(field, index) in fileFields"-->
    <!--                          :key="index"-->
    <!--                          style="width: 45% !important; margin: auto"-->
    <!--                      >-->
    <!--                          <div class="form-group" >-->
    <!--                              <label class="control-label">-->
    <!--                                  {{ $i18n.locale == "ar" ? field.name : field.name_e }}-->
    <!--                              </label>-->
    <!--                              <input-->
    <!--                                  readonly-->
    <!--                                  :value="field.value"-->
    <!--                                  type="text"-->
    <!--                                  class="form-control"-->
    <!--                                  data-create="9"-->
    <!--                                  step="0.1"-->
    <!--                                  style=""-->
    <!--                              />-->
    <!--                          </div>-->
    <!--                      </div>-->
    <!--                  </div>-->
    <!--                  <div class="col-md-12 my-1" v-for="(photo, index) in fileImages" :key="photo.id">-->
    <!--                      <div class="p-2">-->
    <!--                          <div class="row align-items-center">-->
    <!--                              <div class="col-auto" @click="showPhoto = photo.webp">-->
    <!--                                  <img-->
    <!--                                      data-dz-thumbnail-->
    <!--                                      :src="photo.webp"-->
    <!--                                      class="avatar-xxl rounded bg-light"-->
    <!--                                      style="width: 1000px !important; height: 600px !important;"-->
    <!--                                      @error="src = '/images/img-1.png'"-->
    <!--                                  />-->
    <!--                              </div>-->
    <!--                          </div>-->
    <!--                      </div>-->
    <!--                  </div>-->
    <!--              </section>-->
    <!--          </VueHtml2pdf>-->
    <!--      </div>-->
  </Layout>
</template>
<style lang="scss">
.file-print {
  background: none;
}
@media print {
  .col-lg-6 {
    width: 50%;
  }
  .avatar-sm {
    width: 100%;
    height: auto;
  }
  .single-image {
    display: none;
  }
}
.references {
  padding: 10px;
  margin: 10px;
  background: #f8fcff;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;
  height: 420px;
  overflow: auto;

  ul {
    list-style: none;
  }

  ul li {
    padding: 10px 0;
  }
}
input[type="file"] {
  display: none;
}
.modal-dialog .card {
  margin: 0 !important;
}
.country.modal-body {
  padding: 0 !important;
}
.modal-dialog .card-body {
  padding: 1.5rem 1.5rem 0 1.5rem !important;
}
.nav-bordered {
  border: unset !important;
}
.nav {
  background-color: #dff0fe;
}
.tab-content {
  padding: 70px 60px 40px;
  min-height: 300px;
  background-color: #f5f5f5;
  position: relative;
}
.nav-tabs .nav-link {
  border: 1px solid #b7b7b7 !important;
  background-color: #d7e5f2;
  border-bottom: 0 !important;
  margin-bottom: 1px;
}

.nav-tabs .nav-link.active,
.nav-tabs .nav-item.show .nav-link {
  color: #000;
  background-color: hsl(0deg 0% 96%);
  border-bottom: 0 !important;
}

.img-thumbnail {
  max-height: 400px !important;
}
.upload-file {
  label:hover {
    cursor: pointer;
  }

  label {
    padding: 8px;
    border-radius: 5px;
    background: #1abc9c;
    margin-top: 36px;
    color: #fff !important;
  }
}
</style>
