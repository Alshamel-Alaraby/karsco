<script>
import Layout from "../../layouts/main";
import PageHeader from "../../../components/Page-header";
import adminApi from "../../../api/adminAxios";
import Switches from "vue-switches";
import { required, minLength, maxLength, integer } from "vuelidate/lib/validators";
import Swal from "sweetalert2";
import ErrorMessage from "../../../components/widgets/errorMessage";
import loader from "../../../components/loader";
import { dynamicSortString, dynamicSortNumber } from "../../../helper/tableSort";
import translation from "../../../helper/translation-mixin";
import { formatDateOnly } from "../../../helper/startDate";
import Multiselect from "vue-multiselect";

/**
 * Advanced Table component
 */
export default {
  page: {
    title: "Custome table",
    meta: [{ name: "description", content: "Custom table" }],
  },
  mixins: [translation],
  components: {
    Layout,
    PageHeader,
    Switches,
    ErrorMessage,
    loader,
    Multiselect,
  },
  data() {
    return {
      per_page: 50,
      search: "",
      debounce: {},
      customTablesPagination: {},
      branches: [],
      tables: [],
      isLoader: false,
      Tooltip: "",
      mouseEnter: "",
      create: {
        table_name: "",
        columns: [],
      },
      company_id: null,
      errors: {},
      isCheckAll: false,
      checkAll: [],
      current_page: 1,
      setting: {
        name: true,
        name_e: true,
      },
      is_disabled: false,
      filterSetting: ["name", "name_e"],
    };
  },
  validations: {
    create: {
      table_name: { required },
    },
    edit: {
      table_name: { required },
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
      }, 400);
    },
    /**
     * watch check All table
     */
    isCheckAll(after, befour) {
      if (after) {
        this.branches.forEach((el) => {
          if (!this.checkAll.includes(el.id)) {
            this.checkAll.push(el.id);
          }
        });
      } else {
        this.checkAll = [];
      }
    },
  },
  mounted() {
    this.company_id = this.$store.getters["auth/company_id"];
    this.getData();
  },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      if (
        vm.$store.state.auth.work_flow_trees.includes("custom table") ||
        vm.$store.state.auth.user.type == "super_admin"
      ) {
        return true;
      } else {
        return vm.$router.push({ name: "home" });
      }
    });
  },
  methods: {
    async getTables() {
      this.isLoader = true;

      await adminApi
        .get(`/document-field/tables`)
        .then((res) => {
          let l = res.data.data;
          this.tables = l;
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
    async getColumns(table) {
      this.isLoader = true;

      await adminApi
        .get(`/document-field/columns/${table}`)
        .then((res) => {
          let l = res.data.data;
          this.create.columns = l.map((column) => {
            return {
              name: column,
              is_required: 1,
              is_visible: 1,
            };
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
    addNewField() {
      this.create.columns.push({
        name: "",
        name_e: "",
        is_required: 1,
        is_visible: 1,
      });
    },
    removeNewField(index) {
      if (this.create.columns.length > 1) {
        this.create.columns.splice(index, 1);
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
          .get(`/branches/logs/${id}`)
          .then((res) => {
            let l = res.data.data;
            l.forEach((e) => {
              this.Tooltip += `Created By: ${e.causer_type}; Event: ${
                e.event
              }; Description: ${e.description} ;Created At: ${this.formatDate(
                e.created_at
              )} \n`;
            });
          })
          .catch((err) => {
            Swal.fire({
              icon: "error",
              title: `${this.$t("general.Error")}`,
              text: `${this.$t("general.Thereisanerrorinthesystem")}`,
            });
          });
      } else {
      }
    },
    /**
     *  start get Data countrie && pagination
     */
    getData(page = 1) {
      this.isLoader = true;
      let filter = "";
      for (let i = 0; i < this.filterSetting.length; ++i) {
        filter += `columns[${i}]=${this.filterSetting[i]}&`;
      }

      adminApi
        .get(
          `/branches?page=${page}&per_page=${this.per_page}&company_id=${this.company_id}&search=${this.search}&${filter}`
        )
        .then((res) => {
          let l = res.data;
          this.branches = l.data;
          this.customTablesPagination = l.pagination;
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
    getDataCurrentPage(page = 1) {
      if (
        this.current_page <= this.customTablesPagination.last_page &&
        this.current_page != this.customTablesPagination.current_page &&
        this.current_page
      ) {
        this.isLoader = true;
        let filter = "";
        for (let i = 0; i < this.filterSetting.length; ++i) {
          filter += `columns[${i}]=${this.filterSetting[i]}&`;
        }

        adminApi
          .get(
            `/branches?page=${page}&per_page=${this.per_page}&search=${this.search}&${filter}&company_id=${this.company_id}`
          )
          .then((res) => {
            let l = res.data;
            this.branches = l.data;
            this.customTablesPagination = l.pagination;
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

    /**
     *  end get Data countrie && pagination
     */
    /**
     *  start delete countrie
     */
    deleteBranch(id, index) {
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
              .post(`/branches/bulk-delete`, { ids: id })
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
              .delete(`/branches/${id}`)
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
     *  end delete countrie
     */
    /**
     *  reset Modal (create)
     */
    resetModalHidden() {
      this.create = {
        table_name: "",
        columns: [
          {
            name: "",
            name_e: "",
            is_required: 1,
            is_visible: 1,
          },
        ],
      };
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.errors = {};
      this.$bvModal.hide(`create`);
    },
    /**
     *  hidden Modal (create)
     */
    resetModal() {
      this.getTables();
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.errors = {};
    },
    /**
     *  create countrie
     */
    resetForm() {
      this.create = {
        table_name: "",
        columns: [
          {
            name: "",
            name_e: "",
            is_required: 1,
            is_visible: 1,
          },
        ],
      };
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.errors = {};
      this.is_disabled = false;
    },
    AddSubmit() {
      this.$v.create.$touch();

      if (this.$v.create.$invalid) {
        return;
      } else {
        this.isLoader = true;
        this.errors = {};
        adminApi
          .post(`/customTable`, { ...this.create, company_id: this.company_id })
          .then((res) => {
            this.is_disabled = true;
            this.getData();
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
      }
    },
    /**
     *  edit countrie
     */
    editSubmit(id) {
      if (!this.create.name) {
        this.create.name = this.create.name_e;
      }
      if (!this.create.name_e) {
        this.create.name_e = this.create.name;
      }
      this.$v.edit.$touch();

      if (this.$v.edit.$invalid) {
        return;
      } else {
        this.isLoader = true;
        this.errors = {};
        adminApi
          .put(`/branches/${id}`, { ...this.edit, company_id: this.company_id })
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
     *   show Modal (edit)
     */
    resetModalEdit(id) {
      let customTable = this.branches.find((e) => id == e.id);
      this.edit.table_name = customTable.table_name;
      this.edit.columns = customTable.columns;
      this.errors = {};
    },
    /**
     *  hidden Modal (edit)
     */
    resetModalHiddenEdit(id) {
      this.errors = {};
      this.edit = {
        table_name: "",
        columns: [
          {
            name: "",
            name_e: "",
            is_required: 1,
            is_visible: 1,
          },
        ],
      };
    },
    /*
     *  start  dynamicSortString
     */
    sortString(value) {
      return dynamicSortString(value);
    },
    SortNumber(value) {
      return dynamicSortNumber(value);
    },
    /**
     *  start  ckeckRow
     */
    checkRow(id) {
      if (!this.checkAll.includes(id)) {
        this.checkAll.push(id);
      } else {
        let index = this.checkAll.indexOf(id);
        this.checkAll.splice(index, 1);
      }
    },
    /**
     *  end  ckeckRow
     */
    moveInput(tag, c, index) {
      document.querySelector(`${tag}[data-${c}='${index}']`).focus();
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
            <!-- start search -->
            <div class="row justify-content-between align-items-center mb-2">
              <h4 class="header-title">{{ $t("general.customTable") }}</h4>
              <div class="col-xs-10 col-md-9 col-lg-7" style="font-weight: 500">
                <div class="d-inline-block" style="width: 22.2%">
                  <!-- Basic dropdown -->
                  <b-dropdown
                    variant="primary"
                    :text="$t('general.searchSetting')"
                    ref="dropdown"
                    class="btn-block setting-search"
                  >
                    <b-form-checkbox v-model="filterSetting" value="name" class="mb-1">{{
                      getCompanyKey("branch_name_ar")
                    }}</b-form-checkbox>
                    <b-form-checkbox
                      v-model="filterSetting"
                      value="name_e"
                      class="mb-1"
                      >{{ getCompanyKey("branch_name_en") }}</b-form-checkbox
                    >
                  </b-dropdown>
                  <!-- Basic dropdown -->
                </div>

                <div class="d-inline-block position-relative" style="width: 77%">
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
            <!-- end search -->

            <div class="row justify-content-between align-items-center mb-2 px-1">
              <div class="col-md-3 d-flex align-items-center mb-1 mb-xl-0">
                <!-- start create and printer -->
                <b-button
                  v-b-modal.create
                  variant="primary"
                  class="btn-sm mx-1 font-weight-bold"
                >
                  {{ $t("general.Create") }}
                  <i class="fas fa-plus"></i>
                </b-button>
                <div class="d-inline-flex">
                  <button class="custom-btn-dowonload">
                    <i class="fas fa-file-download"></i>
                  </button>
                  <button class="custom-btn-dowonload">
                    <i class="fe-printer"></i>
                  </button>
                  <button
                    class="custom-btn-dowonload"
                    @click="$bvModal.show(`modal-edit-${checkAll[0]}`)"
                    v-if="checkAll.length == 1"
                  >
                    <i class="mdi mdi-square-edit-outline"></i>
                  </button>
                  <!-- start mult delete  -->
                  <button
                    class="custom-btn-dowonload"
                    v-if="checkAll.length > 1"
                    @click.prevent="deleteBranch(checkAll)"
                  >
                    <i class="fas fa-trash-alt"></i>
                  </button>
                  <!-- end mult delete  -->
                  <!--  start one delete  -->
                  <button
                    class="custom-btn-dowonload"
                    v-if="checkAll.length == 1"
                    @click.prevent="deleteBranch(checkAll[0])"
                  >
                    <i class="fas fa-trash-alt"></i>
                  </button>
                  <!--  end one delete  -->
                </div>
                <!-- end create and printer -->
              </div>
              <div
                class="col-xs-10 col-md-9 col-lg-7 d-flex align-items-center justify-content-end"
              >
                <div class="d-fex">
                  <!-- start filter and setting -->
                  <div class="d-inline-block">
                    <b-button class="mx-1 custom-btn-background">
                      {{ $t("general.filter") }}
                      <i class="fas fa-filter"></i>
                    </b-button>
                    <b-button class="mx-1 custom-btn-background">
                      {{ $t("general.group") }}
                      <i class="fe-menu"></i>
                    </b-button>
                    <!-- Basic dropdown -->
                    <b-dropdown
                      variant="primary"
                      :html="`${$t('general.setting')} <i class='fe-settings'></i>`"
                      ref="dropdown"
                      class="dropdown-custom-ali"
                    >
                      <b-form-checkbox v-model="setting.name" class="mb-1"
                        >{{ getCompanyKey("branch_name_ar") }}
                      </b-form-checkbox>
                      <b-form-checkbox v-model="setting.name_e" class="mb-1">
                        {{ getCompanyKey("branch_name_en") }}
                      </b-form-checkbox>
                      <b-form-checkbox v-model="setting.is_active" class="mb-1">
                        {{ getCompanyKey("branch_status") }}
                      </b-form-checkbox>
                      <div class="d-flex justify-content-end">
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm"
                          >Apply</a
                        >
                      </div>
                    </b-dropdown>
                    <!-- Basic dropdown -->
                  </div>
                  <!-- end filter and setting -->

                  <!-- start Pagination -->
                  <div class="d-inline-flex align-items-center pagination-custom">
                    <div class="d-inline-block" style="font-size: 13px">
                      {{ customTablesPagination.from }}-{{ customTablesPagination.to }} /
                      {{ customTablesPagination.total }}
                    </div>
                    <div class="d-inline-block">
                      <a
                        href="javascript:void(0)"
                        :style="{
                          'pointer-events':
                            customTablesPagination.current_page == 1 ? 'none' : '',
                        }"
                        @click.prevent="getData(customTablesPagination.current_page - 1)"
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
                            customTablesPagination.last_page ==
                            customTablesPagination.current_page
                              ? 'none'
                              : '',
                        }"
                        @click.prevent="getData(customTablesPagination.current_page + 1)"
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
              size="lg"
              id="create"
              :title="getCompanyKey('branch_create_form')"
              title-class="font-18"
              body-class="p-4 "
              :hide-footer="true"
              @show="resetModal"
              @hidden="resetModalHidden"
            >
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <form>
                        <div class="mb-3 d-flex justify-content-end">
                          <b-button
                            variant="success"
                            type="button"
                            v-if="!isLoader"
                            @click.prevent="AddSubmit"
                          >
                            {{ $t("general.Add") }}
                          </b-button>
                          <b-button variant="success" class="mx-1" disabled v-else>
                            <b-spinner small></b-spinner>
                            <span class="sr-only">{{ $t("login.Loading") }}...</span>
                          </b-button>
                          <!-- End Cancel Button Modal -->
                        </div>
                        <div class="row mb-4">
                          <div class="col-md-6">
                            <div class="form-group position-relative">
                              <label class="control-label">
                                {{ $t("general.Table") }}
                                <span class="text-danger">*</span>
                              </label>
                              <multiselect
                                @input="getColumns"
                                v-model="create.table_name"
                                :options="tables"
                              >
                              </multiselect>
                              <div
                                v-if="$v.create.table_name.$error || errors.table_name"
                                class="text-danger"
                              >
                                {{ $t("general.fieldIsRequired") }}
                              </div>
                              <template v-if="errors.table_name">
                                <ErrorMessage
                                  v-for="(errorMessage, index) in errors.table_name"
                                  :key="index"
                                  >{{ errorMessage }}</ErrorMessage
                                >
                              </template>
                            </div>
                          </div>
                        </div>
                        <template v-for="(item, index) in create.columns">
                          <div class="row" :key="index">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="control-label">
                                  {{ $t("general.Column") }}
                                </label>
                                <input
                                  readonly
                                  type="text"
                                  class="form-control arabicInput"
                                  data-create="1"
                                  @keypress.enter="moveInput('input', 'create', 2)"
                                  v-model="create.columns[index].name"
                                  id="field-1"
                                />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="mr-2">
                                  {{ $t("general.is_required") }}
                                  <span class="text-danger">*</span>
                                </label>
                                <b-form-group>
                                  <b-form-radio
                                    class="d-inline-block"
                                    v-model="create.columns[index].is_required"
                                    value="1"
                                    >{{ $t("general.Yes") }}
                                  </b-form-radio>
                                  <b-form-radio
                                    class="d-inline-block m-1"
                                    v-model="create.columns[index].is_required"
                                    value="0"
                                    >{{ $t("general.No") }}
                                  </b-form-radio>
                                </b-form-group>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="mr-2">
                                  {{ $t("general.is_visible") }}
                                  <span class="text-danger">*</span>
                                </label>
                                <b-form-group>
                                  <b-form-radio
                                    class="d-inline-block"
                                    v-model="create.columns[index].is_visible"
                                    value="1"
                                    >{{ $t("general.Yes") }}
                                  </b-form-radio>
                                  <b-form-radio
                                    class="d-inline-block m-1"
                                    v-model="create.columns[index].is_visible"
                                    value="0"
                                    >{{ $t("general.No") }}
                                  </b-form-radio>
                                </b-form-group>
                              </div>
                            </div>
                          </div>
                        </template>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </b-modal>
            <!--  /create   -->

            <!-- start .table-responsive-->
            <div class="table-responsive mb-3 custom-table-theme position-relative">
              <!--       start loader       -->
              <loader size="large" v-if="isLoader" />
              <!--       end loader       -->
              <table class="table table-borderless table-hover table-centered m-0">
                <thead>
                  <tr>
                    <th scope="col" style="width: 0">
                      <div class="form-check custom-control">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          v-model="isCheckAll"
                          style="width: 17px; height: 17px"
                        />
                      </div>
                    </th>
                    <th v-if="setting.name">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("branch_name_ar") }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="branches.sort(sortString('name'))"
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="branches.sort(sortString('-name'))"
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.name_e">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("branch_name_en") }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="branches.sort(sortString('name_e'))"
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="branches.sort(sortString('-name_e'))"
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.is_active">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("branch_status") }}</span>
                      </div>
                    </th>
                    <th>
                      {{ $t("general.Action") }}
                    </th>
                    <th><i class="fas fa-ellipsis-v"></i></th>
                  </tr>
                </thead>
                <tbody v-if="branches.length > 0">
                  <tr
                    @click.capture="checkRow(data.id)"
                    @dblclick.prevent="$bvModal.show(`modal-edit-${data.id}`)"
                    v-for="(data, index) in branches"
                    :key="data.id"
                    class="body-tr-custom"
                  >
                    <td>
                      <div class="form-check custom-control" style="min-height: 1.9em">
                        <input
                          style="width: 17px; height: 17px"
                          class="form-check-input"
                          type="checkbox"
                          :value="data.id"
                          v-model="checkAll"
                        />
                      </div>
                    </td>
                    <td v-if="setting.name">
                      <h5 class="m-0 font-weight-normal">{{ data.name }}</h5>
                    </td>
                    <td v-if="setting.name_e">
                      <h5 class="m-0 font-weight-normal">{{ data.name_e }}</h5>
                    </td>
                    <td v-if="setting.is_active">{{ data.is_active }}</td>
                    <td>
                      <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-sm dropdown-toggle dropdown-coustom"
                          data-toggle="dropdown"
                          aria-expanded="false"
                        >
                          {{ $t("general.commands") }}
                          <i class="fas fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-custom">
                          <a
                            class="dropdown-item"
                            href="#"
                            @click="$bvModal.show(`modal-edit-${data.id}`)"
                          >
                            <div
                              class="d-flex justify-content-between align-items-center text-black"
                            >
                              <span>{{ $t("general.edit") }}</span>
                              <i class="mdi mdi-square-edit-outline text-info"></i>
                            </div>
                          </a>
                          <a
                            class="dropdown-item text-black"
                            href="#"
                            @click.prevent="deleteBranch(data.id)"
                          >
                            <div
                              class="d-flex justify-content-between align-items-center text-black"
                            >
                              <span>{{ $t("general.delete") }}</span>
                              <i class="fas fa-times text-danger"></i>
                            </div>
                          </a>
                        </div>
                      </div>

                      <!--  edit   -->
                      <b-modal
                        :id="`modal-edit-${data.id}`"
                        :title="getCompanyKey('branch_edit_form')"
                        title-class="font-18"
                        body-class="p-4"
                        :ref="`edit-${data.id}`"
                        :hide-footer="true"
                        @show="resetModalEdit(data.id)"
                        @hidden="resetModalHiddenEdit(data.id)"
                      >
                        <form>
                          <div class="mb-3 d-flex justify-content-end">
                            <!-- Emulate built in modal footer ok and cancel button actions -->
                            <b-button
                              variant="success"
                              type="submit"
                              class="mx-1"
                              v-if="!isLoader"
                              @click.prevent="editSubmit(data.id)"
                            >
                              {{ $t("general.Edit") }}
                            </b-button>

                            <b-button variant="success" class="mx-1" disabled v-else>
                              <b-spinner small></b-spinner>
                              <span class="sr-only">{{ $t("login.Loading") }}...</span>
                            </b-button>

                            <b-button
                              variant="danger"
                              type="button"
                              @click.prevent="$bvModal.hide(`modal-edit-${data.id}`)"
                            >
                              {{ $t("general.Cancel") }}
                            </b-button>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="edit-1" class="control-label">
                                  {{ getCompanyKey("branch_name_ar") }}
                                  <span class="text-danger">*</span>
                                </label>
                                <input
                                  type="text"
                                  class="form-control arabicInput"
                                  data-edit="1"
                                  @keypress.enter="moveInput('input', 'edit', 2)"
                                  v-model="$v.edit.name.$model"
                                  :class="{
                                    'is-invalid': $v.edit.name.$error || errors.name,
                                    'is-valid': !$v.edit.name.$invalid && !errors.name,
                                  }"
                                  id="edit-1"
                                />
                                <div
                                  v-if="!$v.edit.name.minLength"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.Itmustbeatleast") }}
                                  {{ $v.edit.name.$params.minLength.min }}
                                  {{ $t("general.letters") }}
                                </div>
                                <div
                                  v-if="!$v.edit.name.maxLength"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.Itmustbeatmost") }}
                                  {{ $v.edit.name.$params.maxLength.max }}
                                  {{ $t("general.letters") }}
                                </div>
                                <template v-if="errors.name">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.name"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="edit-2" class="control-label">
                                  {{ getCompanyKey("branch_name_en") }}
                                  <span class="text-danger">*</span>
                                </label>
                                <div dir="ltr">
                                  <input
                                    type="text"
                                    class="form-control englishInput"
                                    data-edit="2"
                                    @keypress.enter="moveInput('select', 'edit', 3)"
                                    v-model="$v.edit.name_e.$model"
                                    :class="{
                                      'is-invalid':
                                        $v.edit.name_e.$error || errors.name_e,
                                      'is-valid':
                                        !$v.edit.name_e.$invalid && !errors.name_e,
                                    }"
                                    id="edit-2"
                                  />
                                </div>
                                <div
                                  v-if="!$v.edit.name_e.minLength"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.Itmustbeatleast") }}
                                  {{ $v.edit.name_e.$params.minLength.min }}
                                  {{ $t("general.letters") }}
                                </div>
                                <div
                                  v-if="!$v.edit.name_e.maxLength"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.Itmustbeatmost") }}
                                  {{ $v.edit.name_e.$params.maxLength.max }}
                                  {{ $t("general.letters") }}
                                </div>
                                <template v-if="errors.name_e">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.name_e"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="mr-2">
                                  {{ getCompanyKey("branch_status") }}
                                  <span class="text-danger">*</span>
                                </label>
                                <b-form-group
                                  :class="{
                                    'is-invalid':
                                      $v.edit.is_active.$error || errors.is_active,
                                    'is-valid':
                                      !$v.edit.is_active.$invalid && !errors.is_active,
                                  }"
                                >
                                  <b-form-radio
                                    class="d-inline-block"
                                    v-model="$v.edit.is_active.$model"
                                    name="some-radios"
                                    value="active"
                                    >{{ $t("general.Active") }}</b-form-radio
                                  >
                                  <b-form-radio
                                    class="d-inline-block m-1"
                                    v-model="$v.edit.is_active.$model"
                                    name="some-radios"
                                    value="inactive"
                                    >{{ $t("general.Inactive") }}</b-form-radio
                                  >
                                </b-form-group>
                                <template v-if="errors.is_active">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.is_active"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                          </div>
                        </form>
                      </b-modal>
                      <!--  /edit   -->
                    </td>
                    <td>
                      <button
                        @mouseover="log(data.id)"
                        @mousemove="log(data.id)"
                        type="button"
                        class="btn"
                        data-toggle="tooltip"
                        :data-placement="$i18n.locale == 'en' ? 'left' : 'right'"
                        :title="Tooltip"
                      >
                        <i class="fe-info" style="font-size: 22px"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <th class="text-center" colspan="11">
                      {{ $t("general.notDataFound") }}
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- end .table-responsive-->
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
<style scoped>
.closeField {
  font-size: 48px !important;
  width: 38px !important;
  padding: 0 0 11px 0 !important;
  height: 36px !important;
  text-align: center;
  line-height: 7px !important;
  background-color: hsl(210deg 6% 86%);
  color: red;
  border: none;
}
.dropdown-menu-custom-company.dropdown .dropdown-menu {
  padding: 5px 10px !important;
  overflow-y: scroll;
  height: 400px;
}

.modal-dialog .card {
  margin: 0 !important;
}

.modal-body.paddingUnset {
  padding: 0 !important;
}

.modal-dialog .card-body {
  padding: 1.5rem 1.5rem 0 1.5rem !important;
}
</style>
