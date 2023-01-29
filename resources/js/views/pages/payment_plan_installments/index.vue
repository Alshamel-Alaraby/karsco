<script>
import Layout from "../../layouts/main";
import PageHeader from "../../../components/Page-header";
import adminApi from "../../../api/adminAxios";
import outerAxios from "../../../api/outerAxios";
import { required, numeric } from "vuelidate/lib/validators";
import Swal from "sweetalert2";
import ErrorMessage from "../../../components/widgets/errorMessage";
import loader from "../../../components/loader";
import { dynamicSortString } from "../../../helper/tableSort";
import { dynamicSortNumber } from "../../../helper/tableSort";
import Multiselect from "vue-multiselect";
import { formatDateTime, formatDateOnly } from "../../../helper/startDate";
import translation from "../../../helper/translation-mixin";
import DatePicker from "vue2-datepicker";

/**
 * Advanced Table component
 */
export default {
  page: {
    title: "Payment plan installment",
    meta: [{ name: "description", content: "Payment plan installment" }],
  },
  mixins: [translation],
  components: {
    Layout,
    PageHeader,
    ErrorMessage,
    loader,
    Multiselect,
    DatePicker,
  },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      if (vm.$store.state.auth.work_flow_trees.includes("payment plan installment")) {
        return true;
      } else {
        return vm.$router.push({ name: "home" });
      }
    });
  },
  data() {
    return {
      per_page: 50,
      search: "",
      debounce: {},
      payemntPlanInstallmentsPagination: {},
      payment_plan_installments: [],
      installment_payment_plans: [],
      installment_payment_plan_details: [],
      installment_statuses: [],
      documentTypes: [],
      screens: [],
      modules: [],
      enabled3: false,
      isLoader: false,
      create: {
        installment_payment_plan_id: null,
        installment_payment_plan_detail_ln_no: null,
        v_date: "",
        due_date: "",
        custome_v_date: "",
        custome_due_date: "",
        total_amount: 0,
        paid_amount: 0,
        installment_status_id: null,
        doc_type: null,
        screen_id: null,
        module_id: null,
        ref_id: 0,
        rp_code: 0,
      },
      edit: {
        installment_payment_plan_id: null,
        installment_payment_plan_detail_ln_no: null,
        v_date: "",
        due_date: "",
        custome_v_date: "",
        custome_due_date: "",

        total_amount: 0,
        paid_amount: 0,
        installment_status_id: null,
        doc_type: null,
        screen_id: null,
        module_id: null,
        ref_id: 0,
        rp_code: 0,
      },
      setting: {
        installment_payment_plan_id: true,
        v_date: true,
        due_date: true,
        total_amount: true,
        paid_amount: true,
        installment_status_id: true,
        doc_type: true,
        screen_id: true,
        module_id: true,
        ref_id: true,
        rp_code: true,
      },
      filterSetting: ["installment_payment_plan_id", "installment_status_id"],
      errors: {},
      isCheckAll: false,
      checkAll: [],
      is_disabled: false,
      current_page: 1,
      company_id: 48,
      Tooltip: "",
      mouseEnter: null,
    };
  },
  validations: {
    create: {
      installment_payment_plan_id: { required },
      installment_payment_plan_detail_ln_no: { required },
      v_date: { required },
      due_date: { required },
      total_amount: { required, numeric },
      paid_amount: { required, numeric },
      installment_status_id: { required },
      doc_type: { required },
      screen_id: { required },
      module_id: { required },
      ref_id: { required, numeric },
      rp_code: { required, numeric },
    },
    edit: {
      installment_payment_plan_id: { required },
      installment_payment_plan_detail_ln_no: { required },
      v_date: { required },
      due_date: { required },
      total_amount: { required },
      paid_amount: { required },
      installment_status_id: { required },
      doc_type: { required },
      screen_id: { required },
      module_id: { required },
      ref_id: { required },
      rp_code: { required },
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
        this.payment_plan_installments.forEach((el) => {
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
    await this.getDocumentTypes();
    await this.getScreens();
    await this.getModules();
    await this.getData();
  },
  methods: {
    v_date(e) {
      if (e) {
        this.create.v_date = formatDateTime(e);
        this.edit.v_date = formatDateTime(e);
      } else {
        this.create.v_date = null;
        this.edit.v_date = null;
      }
    },
    due_date(e) {
      if (e) {
        this.create.due_date = formatDateTime(e);
        this.edit.due_date = formatDateTime(e);
      } else {
        this.create.due_date = null;
        this.edit.due_date = null;
      }
    },

    /**
     *  get Data payment_plan_installments
     */
    async getData(page = 1) {
      this.isLoader = true;
      let _filterSetting = [...this.filterSetting];
      let index = this.filterSetting.indexOf("installment_payment_plan_id");
      if (index > -1) {
        _filterSetting[index] =
          this.$i18n.locale == "ar"
            ? "installment_payment_plan.name"
            : "installment_payment_plan.name_e";
      }
      index = this.filterSetting.indexOf("installment_status_id");
      if (index > -1) {
        _filterSetting[index] =
          this.$i18n.locale == "ar"
            ? "installment_status.name"
            : "installment_status.name_e";
      }
      let filter = "";
      for (let i = 0; i < _filterSetting.length; ++i) {
        filter += `columns[${i}]=${_filterSetting[i]}&`;
      }
      await adminApi
        .get(
          `/recievable-payable/rp_payment_plan_installment?page=${page}&per_page=${this.per_page}&search=${this.search}&${filter}`
        )
        .then((res) => {
          let l = res.data;
          this.payment_plan_installments = l.data;
          this.payemntPlanInstallmentsPagination = l.pagination;
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
        this.current_page <= this.payemntPlanInstallmentsPagination.last_page &&
        this.current_page != this.payemntPlanInstallmentsPagination.current_page &&
        this.current_page
      ) {
        this.isLoader = true;
        let _filterSetting = [...this.filterSetting];
        let index = this.filterSetting.indexOf("installment_payment_plan_id");
        if (index > -1) {
          _filterSetting[index] =
            this.$i18n.locale == "ar"
              ? "installment_payment_plan.name"
              : "installment_payment_plan.name_e";
        }
        index = this.filterSetting.indexOf("installment_status_id");
        if (index > -1) {
          _filterSetting[index] =
            this.$i18n.locale == "ar"
              ? "installment_status.name"
              : "installment_status.name_e";
        }
        let filter = "";
        for (let i = 0; i < _filterSetting.length; ++i) {
          filter += `columns[${i}]=${_filterSetting[i]}&`;
        }

        adminApi
          .get(
            `recievable-payable/rp_payment_plan_installment?page=${this.current_page}&per_page=${this.per_page}&search=${this.search}&${filter}`
          )
          .then((res) => {
            let l = res.data;
            this.payment_plan_installments = l.data;
            this.payemntPlanInstallmentsPagination = l.pagination;
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
              .post(`recievable-payable/rp_payment_plan_installment/bulk-delete`, {
                ids: id,
              })
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
              .delete(`recievable-payable/rp_payment_plan_installment/${id}`)
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
    resetModalHidden() {
      this.create = {
        installment_payment_plan_id: null,
        installment_payment_plan_detail_ln_no: null,
        v_date: "",
        due_date: "",
        custome_v_date: "",
        custome_due_date: "",
        total_amount: 0,
        paid_amount: 0,
        installment_status_id: null,
        doc_type: null,
        screen_id: null,
        module_id: null,
        ref_id: 0,
        rp_code: 0,
      };
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.errors = {};
    },
    /**
     *  hidden Modal (create)
     */
    async resetModal() {
      await this.getInstallmentPaymentPlans();
      await this.getInstallmentPaymentPlanDetails();
      await this.getInstallmentStatuses();
      await this.getDocumentTypes();
      await this.getScreens();
      await this.getModules();
      this.create = {
        installment_payment_plan_id: null,
        installment_payment_plan_detail_ln_no: null,
        v_date: "",
        due_date: "",
        custome_v_date: "",
        custome_due_date: "",
        total_amount: 0,
        paid_amount: 0,
        installment_status_id: null,
        doc_type: null,
        screen_id: null,
        module_id: null,
        ref_id: 0,
        rp_code: 0,
      };
      this.is_disabled = false;
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.errors = {};
    },
    /**
     *  create screen
     */
    resetForm() {
      this.create = {
        installment_payment_plan_id: null,
        installment_payment_plan_detail_ln_no: null,
        v_date: "",
        due_date: "",
        custome_v_date: "",
        custome_due_date: "",

        total_amount: 0,
        paid_amount: 0,
        installment_status_id: null,
        doc_type: null,
        screen_id: null,
        module_id: null,
        ref_id: 0,
        rp_code: 0,
      };
      this.is_disabled = false;
      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    AddSubmit() {
      if (this.$v.create.$invalid) {
        this.$v.create.$touch();
        return;
      } else {
        this.isLoader = true;
        this.errors = {};
        this.is_disabled = false;
        adminApi
          .post(`recievable-payable/rp_payment_plan_installment`, this.create)
          .then((res) => {
            this.getData();
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
      }
    },
    /**
     *  edit screen
     */
    editSubmit(id) {
      this.$v.edit.$touch();
      if (this.$v.edit.$invalid) {
        return;
      } else {
        this.isLoader = true;
        this.errors = {};
        adminApi
          .put(`recievable-payable/rp_payment_plan_installment/${id}`, this.edit)
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
    async getInstallmentPaymentPlans() {
      this.isLoader = true;
      await adminApi
        .get(`recievable-payable/rp_installment_p_plan`)
        .then((res) => {
          this.isLoader = false;
          this.installment_payment_plans = res.data.data;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        });
    },

    async getInstallmentPaymentPlanDetails() {
      this.isLoader = true;
      await adminApi
        .get(`recievable-payable/rp_installment_p_plan_details`)
        .then((res) => {
          this.isLoader = false;
          this.installment_payment_plan_details = res.data.data;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        });
    },
    async getInstallmentStatuses() {
      this.isLoader = true;
      await adminApi
        .get(`recievable-payable/rp_installment_status`)
        .then((res) => {
          this.isLoader = false;
          this.installment_statuses = res.data.data;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        });
    },
    async getDocumentTypes() {
      this.isLoader = true;
      await outerAxios
        .get(`/document-type`)
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
    async getScreens() {
      this.isLoader = true;
      await outerAxios
        .get(`/screens`)
        .then((res) => {
          this.isLoader = false;
          this.screens = res.data.data;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: `${this.$t("general.Error")}`,
            text: `${this.$t("general.Thereisanerrorinthesystem")}`,
          });
        });
    },
    async getModules() {
      this.isLoader = true;
      await outerAxios
        .get(`/modules`)
        .then((res) => {
          this.isLoader = false;
          this.modules = res.data.data;
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
      let paymentPlanInstallment = this.payment_plan_installments.find((e) => id == e.id);
      await this.getInstallmentPaymentPlans();
      await this.getInstallmentPaymentPlanDetails();
      await this.getInstallmentStatuses();
      await this.getDocumentTypes();
      await this.getScreens();
      await this.getModules();
      this.edit.installment_payment_plan_id =
        paymentPlanInstallment.installment_payment_plan_id;
      this.edit.installment_payment_plan_detail_ln_no =
        paymentPlanInstallment.installment_payment_plan_detail_ln_no;
      this.edit.installment_status_id = paymentPlanInstallment.installment_status_id;
      this.edit.custom_v_date = new Date(paymentPlanInstallment.v_date);
      this.edit.custom_due_date = new Date(paymentPlanInstallment.due_date);
      this.edit.v_date = formatDateTime(paymentPlanInstallment.v_date);
      this.edit.due_date = formatDateTime(paymentPlanInstallment.due_date);
      this.edit.total_amount = paymentPlanInstallment.total_amount;
      this.edit.paid_amount = paymentPlanInstallment.paid_amount;
      this.edit.doc_type = paymentPlanInstallment.doc_type;
      this.edit.screen_id = paymentPlanInstallment.screen_id;
      this.edit.module_id = paymentPlanInstallment.module_id;
      this.edit.ref_id = paymentPlanInstallment.ref_id;
      this.edit.rp_code = paymentPlanInstallment.rp_code;
      this.errors = {};
    },
    /**
     *  hidden Modal (edit)
     */
    resetModalHiddenEdit(id) {
      this.errors = {};
      this.edit = {
        installment_payment_plan_id: null,
        installment_payment_plan_detail_ln_no: null,
        v_date: "",
        due_date: "",
        custome_v_date: "",
        custome_due_date: "",

        total_amount: 0,
        paid_amount: 0,
        installment_status_id: null,
        doc_type: null,
        screen_id: null,
        module_id: null,
        ref_id: 0,
        rp_code: 0,
      };
    },

    /**
     *  start  dynamicSortString
     */
    sortString(value) {
      return dynamicSortString(value);
    },
    sortNumber(value) {
      return dynamicSortNumber(value);
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
          .get(`recievable-payable/rp_payment_plan_installment/logs/${id}`)
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
              <h4 class="header-title">
                {{ $t("general.paymentPlanInstallmentsTable") }}
              </h4>
              <div class="col-xs-10 col-md-9 col-lg-7" style="font-weight: 500">
                <div class="d-inline-block" style="width: 22.2%">
                  <!-- Basic dropdown -->
                  <b-dropdown
                    variant="primary"
                    :text="$t('general.searchSetting')"
                    ref="dropdown"
                    class="btn-block setting-search"
                  >
                    <b-form-checkbox
                      v-model="filterSetting"
                      value="installment_payment_plan_id"
                      class="mb-1"
                      >{{ getCompanyKey("installment_payment_plan") }}</b-form-checkbox
                    >
                    <b-form-checkbox
                      v-model="filterSetting"
                      value="installment_status_id"
                      class="mb-1"
                      >{{ getCompanyKey("installment_status") }}</b-form-checkbox
                    >
                  </b-dropdown>
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

            <div class="row justify-content-between align-items-center mb-2 px-1">
              <div class="col-md-3 d-flex align-items-center mb-1 mb-xl-0">
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
                    @click.prevent="deleteScreenButton(checkAll)"
                  >
                    <i class="fas fa-trash-alt"></i>
                  </button>
                  <!-- end mult delete  -->
                  <!--  start one delete  -->
                  <button
                    class="custom-btn-dowonload"
                    v-if="checkAll.length == 1"
                    @click.prevent="deleteScreenButton(checkAll[0])"
                  >
                    <i class="fas fa-trash-alt"></i>
                  </button>
                  <!--  end one delete  -->
                </div>
              </div>
              <div
                class="col-xs-10 col-md-9 col-lg-7 d-flex align-items-center justify-content-end"
              >
                <div>
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
                    <b-form-checkbox
                      v-model="setting.installment_payment_plan_id"
                      class="mb-1"
                      >{{ getCompanyKey("installment_payment_plan") }}
                    </b-form-checkbox>
                    <b-form-checkbox v-model="setting.v_date" class="mb-1">
                      {{ getCompanyKey("installment_payment_plan_v_date") }}
                    </b-form-checkbox>
                    <b-form-checkbox v-model="setting.due_date" class="mb-1">
                      {{ getCompanyKey("installment_payment_plan_due_date") }}
                    </b-form-checkbox>
                    <b-form-checkbox v-model="setting.total_amount" class="mb-1">
                      {{ getCompanyKey("installment_payment_plan_total_amount") }}
                    </b-form-checkbox>
                    <b-form-checkbox v-model="setting.paid_amount" class="mb-1">
                      {{ getCompanyKey("installment_payment_plan_paid_amount") }}
                    </b-form-checkbox>

                    <b-form-checkbox v-model="setting.installment_status_id" class="mb-1">
                      {{ getCompanyKey("installment_status") }}
                    </b-form-checkbox>

                    <b-form-checkbox v-model="setting.doc_type" class="mb-1">
                      {{ getCompanyKey("doc_type") }}
                    </b-form-checkbox>

                    <b-form-checkbox v-model="setting.module_id" class="mb-1">
                      {{ getCompanyKey("module") }}
                    </b-form-checkbox>

                    <b-form-checkbox v-model="setting.screen_id" class="mb-1">
                      {{ getCompanyKey("screen") }}
                    </b-form-checkbox>

                    <b-form-checkbox v-model="setting.ref_id" class="mb-1">
                      {{ getCompanyKey("ref_id") }}
                    </b-form-checkbox>

                    <b-form-checkbox v-model="setting.rp_code" class="mb-1">
                      {{ getCompanyKey("rp_code") }}
                    </b-form-checkbox>

                    <div class="d-flex justify-content-end">
                      <a href="javascript:void(0)" class="btn btn-primary btn-sm">{{
                        $t("general.Apply")
                      }}</a>
                    </div>
                  </b-dropdown>
                  <!-- Basic dropdown -->
                  <!-- start Pagination -->
                  <div class="d-inline-flex align-items-center pagination-custom">
                    <div class="d-inline-block" style="font-size: 15px">
                      {{ payemntPlanInstallmentsPagination.from }}-{{
                        payemntPlanInstallmentsPagination.to
                      }}
                      /
                      {{ payemntPlanInstallmentsPagination.total }}
                    </div>
                    <div class="d-inline-block">
                      <a
                        href="javascript:void(0)"
                        :style="{
                          'pointer-events':
                            payemntPlanInstallmentsPagination.current_page == 1
                              ? 'none'
                              : '',
                        }"
                        @click.prevent="
                          getData(payemntPlanInstallmentsPagination.current_page - 1)
                        "
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
                            payemntPlanInstallmentsPagination.last_page ==
                            payemntPlanInstallmentsPagination.current_page
                              ? 'none'
                              : '',
                        }"
                        @click.prevent="
                          getData(payemntPlanInstallmentsPagination.current_page + 1)
                        "
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
              id="create"
              :title="getCompanyKey('payment_plan_installment_create_form')"
              title-class="font-18"
              body-class="p-4 "
              size="lg"
              :hide-footer="true"
              @show="resetModal"
              @hidden="resetModalHidden"
            >
              <form>
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
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="my-1 mr-2">{{
                        getCompanyKey("installment_payment_plan")
                      }}</label>
                      <multiselect
                        v-model="create.installment_payment_plan_id"
                        :options="installment_payment_plans.map((type) => type.id)"
                        :custom-label="
                          (opt) =>
                            $i18n.locale == 'ar'
                              ? installment_payment_plans.find((x) => x.id == opt).name
                              : installment_payment_plans.find((x) => x.id == opt).name_e
                        "
                        :class="{
                          'is-invalid':
                            $v.create.installment_payment_plan_id.$error ||
                            errors.installment_payment_plan_id,
                        }"
                      >
                      </multiselect>
                      <div
                        v-if="!$v.create.installment_payment_plan_id.required"
                        class="invalid-feedback"
                      >
                        {{ $t("general.fieldIsRequired") }}
                      </div>

                      <template v-if="errors.installment_payment_plan_id">
                        <ErrorMessage
                          v-for="(
                            errorMessage, index
                          ) in errors.installment_payment_plan_id"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="my-1 mr-2">{{
                        getCompanyKey("installment_payment_plan_detail")
                      }}</label>
                      <multiselect
                        v-model="create.installment_payment_plan_detail_ln_no"
                        :options="installment_payment_plan_details.map((type) => type.id)"
                        :custom-label="
                          (opt) =>
                            installment_payment_plan_details.find((x) => x.id == opt)
                              .interest_value
                        "
                        :class="{
                          'is-invalid':
                            $v.create.installment_payment_plan_detail_ln_no.$error ||
                            errors.installment_payment_plan_detail_ln_no,
                        }"
                      >
                      </multiselect>
                      <div
                        v-if="!$v.create.installment_payment_plan_detail_ln_no.required"
                        class="invalid-feedback"
                      >
                        {{ $t("general.fieldIsRequired") }}
                      </div>
                      <template v-if="errors.installment_payment_plan_detail_ln_no">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.button_id"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="my-1 mr-2">{{
                        getCompanyKey("installment_status")
                      }}</label>
                      <multiselect
                        v-model="create.installment_status_id"
                        :options="installment_statuses.map((type) => type.id)"
                        :custom-label="
                          (opt) =>
                            $i18n.locale == 'ar'
                              ? installment_statuses.find((x) => x.id == opt).name
                              : installment_statuses.find((x) => x.id == opt).name_e
                        "
                        :class="{
                          'is-invalid':
                            $v.create.installment_status_id.$error ||
                            errors.installment_status_id,
                        }"
                      >
                      </multiselect>
                      <div
                        v-if="!$v.create.installment_status_id.required"
                        class="invalid-feedback"
                      >
                        {{ $t("general.fieldIsRequired") }}
                      </div>

                      <template v-if="errors.installment_status_id">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.installment_status_id"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="my-1 mr-2">{{ getCompanyKey("doc_type") }}</label>
                      <multiselect
                        v-model="create.doc_type"
                        :options="documentTypes.map((type) => type.id)"
                        :custom-label="
                          (opt) =>
                            $i18n.locale == 'ar'
                              ? documentTypes.find((x) => x.id == opt).name
                              : documentTypes.find((x) => x.id == opt).name_e
                        "
                        :class="{
                          'is-invalid': $v.create.doc_type.$error || errors.doc_type,
                        }"
                      >
                      </multiselect>
                      <div v-if="!$v.create.doc_type.required" class="invalid-feedback">
                        {{ $t("general.fieldIsRequired") }}
                      </div>

                      <template v-if="errors.doc_type">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.doc_type"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="my-1 mr-2">{{ getCompanyKey("screen") }}</label>
                      <multiselect
                        v-model="create.screen_id"
                        :options="screens.map((type) => type.id)"
                        :custom-label="
                          (opt) =>
                            $i18n.locale == 'ar'
                              ? screens.find((x) => x.id == opt).name
                              : screens.find((x) => x.id == opt).name_e
                        "
                        :class="{
                          'is-invalid': $v.create.screen_id.$error || errors.screen_id,
                        }"
                      >
                      </multiselect>
                      <div v-if="!$v.create.screen_id.required" class="invalid-feedback">
                        {{ $t("general.fieldIsRequired") }}
                      </div>

                      <template v-if="errors.screen_id">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.screen_id"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="my-1 mr-2">{{ getCompanyKey("module") }}</label>
                      <multiselect
                        v-model="create.module_id"
                        :options="modules.map((type) => type.id)"
                        :custom-label="
                          (opt) =>
                            $i18n.locale == 'ar'
                              ? modules.find((x) => x.id == opt).name
                              : modules.find((x) => x.id == opt).name_e
                        "
                        :class="{
                          'is-invalid': $v.create.module_id.$error || errors.module_id,
                        }"
                      >
                      </multiselect>
                      <div v-if="!$v.create.module_id.required" class="invalid-feedback">
                        {{ $t("general.fieldIsRequired") }}
                      </div>

                      <template v-if="errors.module_id">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.module_id"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label">
                        {{ getCompanyKey("installment_payment_plan_v_date") }}
                        <span class="text-danger">*</span>
                      </label>
                      <date-picker
                        v-model="create.custom_v_date"
                        type="date"
                        @change="v_date"
                        confirm
                      ></date-picker>
                      <div v-if="!$v.create.v_date.required" class="invalid-feedback">
                        {{ $t("general.fieldIsRequired") }}
                      </div>
                      <template v-if="errors.v_date">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.v_date"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label">
                        {{ getCompanyKey("installment_payment_plan_due_date") }}
                        <span class="text-danger">*</span>
                      </label>
                      <date-picker
                        v-model="create.custom_due_date"
                        type="date"
                        :default-value="create.due_date"
                        @change="due_date"
                        confirm
                      ></date-picker>
                      <div v-if="!$v.create.due_date.required" class="invalid-feedback">
                        {{ $t("general.fieldIsRequired") }}
                      </div>
                      <template v-if="errors.due_date">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.due_date"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label">
                        {{ getCompanyKey("installment_payment_plan_total_amount") }}
                        <span class="text-danger">*</span>
                      </label>
                      <input
                        type="number"
                        class="form-control"
                        data-create="9"
                        step="0.1"
                        @keypress.enter="moveInput('select', 'create', 10)"
                        v-model="$v.create.total_amount.$model"
                        :class="{
                          'is-invalid':
                            $v.create.total_amount.$error || errors.total_amount,
                          'is-valid':
                            !$v.create.total_amount.$invalid && !errors.total_amount,
                        }"
                      />
                      <template v-if="errors.total_amount">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.total_amount"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label">
                        {{ getCompanyKey("installment_payment_plan_paid_amount") }}
                        <span class="text-danger">*</span>
                      </label>
                      <input
                        type="number"
                        class="form-control"
                        data-create="9"
                        step="0.1"
                        @keypress.enter="moveInput('select', 'create', 10)"
                        v-model="$v.create.paid_amount.$model"
                        :class="{
                          'is-invalid':
                            $v.create.paid_amount.$error || errors.paid_amount,
                          'is-valid':
                            !$v.create.paid_amount.$invalid && !errors.paid_amount,
                        }"
                      />
                      <template v-if="errors.paid_amount">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.paid_amount"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label">
                        {{ getCompanyKey("ref_id") }}
                        <span class="text-danger">*</span>
                      </label>
                      <input
                        type="number"
                        class="form-control"
                        data-create="9"
                        step="0.1"
                        @keypress.enter="moveInput('select', 'create', 10)"
                        v-model="$v.create.ref_id.$model"
                        :class="{
                          'is-invalid': $v.create.ref_id.$error || errors.ref_id,
                          'is-valid': !$v.create.ref_id.$invalid && !errors.ref_id,
                        }"
                      />
                      <template v-if="errors.ref_id">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.ref_id"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label">
                        {{ getCompanyKey("rp_code") }}
                        <span class="text-danger">*</span>
                      </label>
                      <input
                        type="number"
                        class="form-control"
                        data-create="9"
                        step="0.1"
                        @keypress.enter="moveInput('select', 'create', 10)"
                        v-model="$v.create.rp_code.$model"
                        :class="{
                          'is-invalid': $v.create.rp_code.$error || errors.rp_code,
                          'is-valid': !$v.create.rp_code.$invalid && !errors.rp_code,
                        }"
                      />
                      <template v-if="errors.rp_code">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.rp_code"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
                </div>
              </form>
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
                    <th v-if="setting.installment_payment_plan_id">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("installment_payment_plan") }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? 'name' : 'name_e')
                              )
                            "
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? '-name' : '-name_e')
                              )
                            "
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.installment_status_id">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("installment_status") }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? 'name' : 'name_e')
                              )
                            "
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? '-name' : '-name_e')
                              )
                            "
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.doc_type">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("doc_type") }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? 'name' : 'name_e')
                              )
                            "
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? '-name' : '-name_e')
                              )
                            "
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.screen_id">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("screen") }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? 'name' : 'name_e')
                              )
                            "
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? '-name' : '-name_e')
                              )
                            "
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.module_id">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("module") }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? 'name' : 'name_e')
                              )
                            "
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="
                              payment_plan_installments.sort(
                                sortString($i18n.locale == 'ar' ? '-name' : '-name_e')
                              )
                            "
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.v_date">
                      <div class="d-flex justify-content-center">
                        <span>{{
                          getCompanyKey("installment_payment_plan_v_date")
                        }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="payment_plan_installments.sort(sortString('v_date'))"
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="payment_plan_installments.sort(sortString('-v_date'))"
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.due_date">
                      <div class="d-flex justify-content-center">
                        <span>{{
                          getCompanyKey("installment_payment_plan_due_date")
                        }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="
                              payment_plan_installments.sort(sortString('due_date'))
                            "
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="
                              payment_plan_installments.sort(sortString('-due_date'))
                            "
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.total_amount">
                      <div class="d-flex justify-content-center">
                        <span>{{
                          getCompanyKey("installment_payment_plan_total_amount")
                        }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="
                              payment_plan_installments.sort(sortNumber('total_amount'))
                            "
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="
                              payment_plan_installments.sort(sortNumber('-total_amount'))
                            "
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.paid_amount">
                      <div class="d-flex justify-content-center">
                        <span>{{
                          getCompanyKey("installment_payment_plan_paid_amount")
                        }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="
                              payment_plan_installments.sort(sortNumber('paid_amount'))
                            "
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="
                              payment_plan_installments.sort(sortNumber('-paid_amount'))
                            "
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.ref_id">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("ref_id") }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="payment_plan_installments.sort(sortNumber('ref_id'))"
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="payment_plan_installments.sort(sortNumber('-ref_id'))"
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th v-if="setting.rp_code">
                      <div class="d-flex justify-content-center">
                        <span>{{ getCompanyKey("rp_code") }}</span>
                        <div class="arrow-sort">
                          <i
                            class="fas fa-arrow-up"
                            @click="payment_plan_installments.sort(sortNumber('rp_code'))"
                          ></i>
                          <i
                            class="fas fa-arrow-down"
                            @click="
                              payment_plan_installments.sort(sortNumber('-rp_code'))
                            "
                          ></i>
                        </div>
                      </div>
                    </th>
                    <th>
                      {{ $t("general.Action") }}
                    </th>
                    <th><i class="fas fa-ellipsis-v"></i></th>
                  </tr>
                </thead>
                <tbody v-if="payment_plan_installments.length > 0">
                  <tr
                    @click.capture="checkRow(data.id)"
                    @dblclick.prevent="$bvModal.show(`modal-edit-${data.id}`)"
                    v-for="(data, index) in payment_plan_installments"
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
                    <td v-if="setting.installment_payment_plan_id">
                      <h5 class="m-0 font-weight-normal">
                        {{
                          $i18n.locale == "ar"
                            ? data.installment_payment_plan.name
                            : data.installment_payment_plan.name_e
                        }}
                      </h5>
                    </td>
                    <td v-if="setting.installment_status_id">
                      <h5 class="m-0 font-weight-normal">
                        {{
                          $i18n.locale == "ar"
                            ? data.installment_status.name
                            : data.installment_status.name_e
                        }}
                      </h5>
                    </td>
                    <td v-if="setting.doc_type">
                      <h5 class="m-0 font-weight-normal">
                        {{
                          documentTypes.length > 0
                            ? $i18n.locale == "ar"
                              ? documentTypes.find((x) => x.id == data.doc_type).name
                              : documentTypes.find((x) => x.id == data.doc_type).name_e
                            : ""
                        }}
                      </h5>
                    </td>

                    <td v-if="setting.screen_id">
                      <h5 class="m-0 font-weight-normal">
                        {{
                          screens.length > 0
                            ? $i18n.locale == "ar"
                              ? screens.find((x) => x.id == data.screen_id).name
                              : screens.find((x) => x.id == data.screen_id).name_e
                            : ""
                        }}
                      </h5>
                    </td>
                    <td v-if="setting.module_id">
                      <h5 class="m-0 font-weight-normal">
                        {{
                          modules.length > 0
                            ? $i18n.locale == "ar"
                              ? modules.find((x) => x.id == data.module_id).name
                              : modules.find((x) => x.id == data.module_id).name_e
                            : ""
                        }}
                      </h5>
                    </td>
                    <td v-if="setting.v_date">
                      <h5 class="m-0 font-weight-normal">
                        {{ formatDate(data.v_date) }}
                      </h5>
                    </td>

                    <td v-if="setting.due_date">
                      <h5 class="m-0 font-weight-normal">
                        {{ formatDate(data.due_date) }}
                      </h5>
                    </td>

                    <td v-if="setting.total_amount">
                      <h5 class="m-0 font-weight-normal">
                        {{ data.total_amount }}
                      </h5>
                    </td>

                    <td v-if="setting.paid_amount">
                      <h5 class="m-0 font-weight-normal">
                        {{ data.paid_amount }}
                      </h5>
                    </td>

                    <td v-if="setting.ref_id">
                      <h5 class="m-0 font-weight-normal">
                        {{ data.ref_id }}
                      </h5>
                    </td>

                    <td v-if="setting.rp_code">
                      <h5 class="m-0 font-weight-normal">
                        {{ data.rp_code }}
                      </h5>
                    </td>

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
                            @click.prevent="deleteScreenButton(data.id)"
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
                        :title="getCompanyKey('payment_plan_installment_edit_form')"
                        title-class="font-18"
                        body-class="p-4"
                        size="lg"
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
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="my-1 mr-2">{{
                                  getCompanyKey("installment_payment_plan")
                                }}</label>
                                <multiselect
                                  v-model="edit.installment_payment_plan_id"
                                  :options="
                                    installment_payment_plans.map((type) => type.id)
                                  "
                                  :custom-label="
                                    (opt) =>
                                      $i18n.locale == 'ar'
                                        ? installment_payment_plans.find(
                                            (x) => x.id == opt
                                          ).name
                                        : installment_payment_plans.find(
                                            (x) => x.id == opt
                                          ).name_e
                                  "
                                  :class="{
                                    'is-invalid':
                                      $v.edit.installment_payment_plan_id.$error ||
                                      errors.installment_payment_plan_id,
                                  }"
                                >
                                </multiselect>
                                <div
                                  v-if="!$v.edit.installment_payment_plan_id.required"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.fieldIsRequired") }}
                                </div>

                                <template v-if="errors.installment_payment_plan_id">
                                  <ErrorMessage
                                    v-for="(
                                      errorMessage, index
                                    ) in errors.installment_payment_plan_id"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="my-1 mr-2">{{
                                  getCompanyKey("installment_payment_plan_detail")
                                }}</label>
                                <multiselect
                                  v-model="edit.installment_payment_plan_detail_ln_no"
                                  :options="
                                    installment_payment_plan_details.map(
                                      (type) => type.id
                                    )
                                  "
                                  :custom-label="
                                    (opt) =>
                                      installment_payment_plan_details.find(
                                        (x) => x.id == opt
                                      ).interest_value
                                  "
                                  :class="{
                                    'is-invalid':
                                      $v.edit.installment_payment_plan_detail_ln_no
                                        .$error ||
                                      errors.installment_payment_plan_detail_ln_no,
                                  }"
                                >
                                </multiselect>
                                <div
                                  v-if="
                                    !$v.edit.installment_payment_plan_detail_ln_no
                                      .required
                                  "
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.fieldIsRequired") }}
                                </div>
                                <template
                                  v-if="errors.installment_payment_plan_detail_ln_no"
                                >
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.button_id"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="my-1 mr-2">{{
                                  getCompanyKey("installment_status")
                                }}</label>
                                <multiselect
                                  v-model="edit.installment_status_id"
                                  :options="installment_statuses.map((type) => type.id)"
                                  :custom-label="
                                    (opt) =>
                                      $i18n.locale == 'ar'
                                        ? installment_statuses.find((x) => x.id == opt)
                                            .name
                                        : installment_statuses.find((x) => x.id == opt)
                                            .name_e
                                  "
                                  :class="{
                                    'is-invalid':
                                      $v.edit.installment_status_id.$error ||
                                      errors.installment_status_id,
                                  }"
                                >
                                </multiselect>
                                <div
                                  v-if="!$v.edit.installment_status_id.required"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.fieldIsRequired") }}
                                </div>

                                <template v-if="errors.installment_status_id">
                                  <ErrorMessage
                                    v-for="(
                                      errorMessage, index
                                    ) in errors.installment_status_id"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="my-1 mr-2">{{
                                  getCompanyKey("doc_type")
                                }}</label>
                                <multiselect
                                  v-model="edit.doc_type"
                                  :options="documentTypes.map((type) => type.id)"
                                  :custom-label="
                                    (opt) =>
                                      $i18n.locale == 'ar'
                                        ? documentTypes.find((x) => x.id == opt).name
                                        : documentTypes.find((x) => x.id == opt).name_e
                                  "
                                  :class="{
                                    'is-invalid':
                                      $v.edit.doc_type.$error || errors.doc_type,
                                  }"
                                >
                                </multiselect>
                                <div
                                  v-if="!$v.edit.doc_type.required"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.fieldIsRequired") }}
                                </div>

                                <template v-if="errors.doc_type">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.doc_type"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="my-1 mr-2">{{
                                  getCompanyKey("screen")
                                }}</label>
                                <multiselect
                                  v-model="edit.screen_id"
                                  :options="screens.map((type) => type.id)"
                                  :custom-label="
                                    (opt) =>
                                      $i18n.locale == 'ar'
                                        ? screens.find((x) => x.id == opt).name
                                        : screens.find((x) => x.id == opt).name_e
                                  "
                                  :class="{
                                    'is-invalid':
                                      $v.edit.screen_id.$error || errors.screen_id,
                                  }"
                                >
                                </multiselect>
                                <div
                                  v-if="!$v.edit.screen_id.required"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.fieldIsRequired") }}
                                </div>

                                <template v-if="errors.screen_id">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.screen_id"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="my-1 mr-2">{{
                                  getCompanyKey("module")
                                }}</label>
                                <multiselect
                                  v-model="edit.module_id"
                                  :options="modules.map((type) => type.id)"
                                  :custom-label="
                                    (opt) =>
                                      $i18n.locale == 'ar'
                                        ? modules.find((x) => x.id == opt).name
                                        : modules.find((x) => x.id == opt).name_e
                                  "
                                  :class="{
                                    'is-invalid':
                                      $v.edit.module_id.$error || errors.module_id,
                                  }"
                                >
                                </multiselect>
                                <div
                                  v-if="!$v.edit.module_id.required"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.fieldIsRequired") }}
                                </div>

                                <template v-if="errors.module_id">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.module_id"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="control-label">
                                  {{ getCompanyKey("installment_payment_plan_v_date") }}
                                  <span class="text-danger">*</span>
                                </label>
                                <date-picker
                                  v-model="edit.custom_v_date"
                                  type="date"
                                  :default-value="edit.v_date"
                                  @change="v_date"
                                  confirm
                                ></date-picker>
                                <div
                                  v-if="!$v.edit.v_date.required"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.fieldIsRequired") }}
                                </div>
                                <template v-if="errors.v_date">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.v_date"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="control-label">
                                  {{ getCompanyKey("installment_payment_plan_due_date") }}
                                  <span class="text-danger">*</span>
                                </label>
                                <date-picker
                                  v-model="edit.custom_due_date"
                                  type="date"
                                  :default-value="edit.due_date"
                                  @change="due_date"
                                  confirm
                                ></date-picker>
                                <div
                                  v-if="!$v.edit.due_date.required"
                                  class="invalid-feedback"
                                >
                                  {{ $t("general.fieldIsRequired") }}
                                </div>
                                <template v-if="errors.due_date">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.due_date"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="control-label">
                                  {{
                                    getCompanyKey("installment_payment_plan_total_amount")
                                  }}
                                  <span class="text-danger">*</span>
                                </label>
                                <input
                                  type="number"
                                  class="form-control"
                                  data-create="9"
                                  step="0.1"
                                  @keypress.enter="moveInput('select', 'create', 10)"
                                  v-model="$v.edit.total_amount.$model"
                                  :class="{
                                    'is-invalid':
                                      $v.edit.total_amount.$error || errors.total_amount,
                                    'is-valid':
                                      !$v.edit.total_amount.$invalid &&
                                      !errors.total_amount,
                                  }"
                                />
                                <template v-if="errors.total_amount">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.total_amount"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="control-label">
                                  {{
                                    getCompanyKey("installment_payment_plan_paid_amount")
                                  }}
                                  <span class="text-danger">*</span>
                                </label>
                                <input
                                  type="number"
                                  class="form-control"
                                  data-create="9"
                                  step="0.1"
                                  @keypress.enter="moveInput('select', 'create', 10)"
                                  v-model="$v.edit.paid_amount.$model"
                                  :class="{
                                    'is-invalid':
                                      $v.edit.paid_amount.$error || errors.paid_amount,
                                    'is-valid':
                                      !$v.edit.paid_amount.$invalid &&
                                      !errors.paid_amount,
                                  }"
                                />
                                <template v-if="errors.paid_amount">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.paid_amount"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="control-label">
                                  {{ getCompanyKey("ref_id") }}
                                  <span class="text-danger">*</span>
                                </label>
                                <input
                                  type="number"
                                  class="form-control"
                                  data-create="9"
                                  step="0.1"
                                  @keypress.enter="moveInput('select', 'create', 10)"
                                  v-model="$v.edit.ref_id.$model"
                                  :class="{
                                    'is-invalid': $v.edit.ref_id.$error || errors.ref_id,
                                    'is-valid':
                                      !$v.edit.ref_id.$invalid && !errors.ref_id,
                                  }"
                                />
                                <template v-if="errors.ref_id">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.ref_id"
                                    :key="index"
                                    >{{ errorMessage }}</ErrorMessage
                                  >
                                </template>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="control-label">
                                  {{ getCompanyKey("rp_code") }}
                                  <span class="text-danger">*</span>
                                </label>
                                <input
                                  type="number"
                                  class="form-control"
                                  data-create="9"
                                  step="0.1"
                                  @keypress.enter="moveInput('select', 'create', 10)"
                                  v-model="$v.edit.rp_code.$model"
                                  :class="{
                                    'is-invalid':
                                      $v.edit.rp_code.$error || errors.rp_code,
                                    'is-valid':
                                      !$v.edit.rp_code.$invalid && !errors.rp_code,
                                  }"
                                />
                                <template v-if="errors.rp_code">
                                  <ErrorMessage
                                    v-for="(errorMessage, index) in errors.rp_code"
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
                        @mousemove="log(data.id)"
                        @mouseover="log(data.id)"
                        type="button"
                        class="btn"
                        :id="`tooltip-${data.id}`"
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
                    <th class="text-center" colspan="14">
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
