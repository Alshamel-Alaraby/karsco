<script>
import Layout from "../../layouts/main";
import PageHeader from "../../../components/Page-header";
import adminApi from "../../../api/adminAxios";
import Switches from "vue-switches";
import {required, minLength, maxLength, integer, numeric} from "vuelidate/lib/validators";
import Swal from "sweetalert2";
import ErrorMessage from "../../../components/widgets/errorMessage";
import loader from "../../../components/loader";
import RoleType from "../../../components/create/roleType.vue";
import {dynamicSortString} from "../../../helper/tableSort";
import Multiselect from "vue-multiselect";
import {formatDateOnly} from "../../../helper/startDate";
import translation from "../../../helper/translation-mixin";

/**
 * Advanced Table component
 */
export default {
    page: {
        title: "Installment Payment Plan Detail",
        meta: [{name: "Installment Payment Plan Detail", content: "Installment Payment Plan Detail"}],
    },
    mixins: [translation],
    components: {
        RoleType,
        Layout,
        PageHeader,
        Switches,
        ErrorMessage,
        loader,
        Multiselect,
    },
    beforeRouteEnter(to, from, next) {
        next((vm) => {
                          if (vm.$store.state.auth.work_flow_trees.includes("receivable payable-e")) {
        Swal.fire({
          icon: "error",
          title: `${vm.$t("general.Error")}`,
          text: `${vm.$t("general.ModuleExpired")}`,
        });
        return vm.$router.push({ name: "home" });
      }


            if (vm.$store.state.auth.work_flow_trees.includes('installment payment plan detail') || vm.$store.state.auth.work_flow_trees.includes('receivable payable') || vm.$store.state.auth.user.type == 'super_admin') {
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
            planDetailsPagination: {},
            planDetails: [],
            parents: [],
            enabled3: false,
            isLoader: false,
            create: {
                is_fixed: 0,
                ln_no: 0,
                installment_payment_type_per: 0,
                installment_payment_type_amount: 0,
                installment_payment_type_freq: 0,
                interest_per: 0,
                interest_value: 0,
                installment_payment_type_id: null,
            },
            edit: {
                is_fixed: 0,
                ln_no: 0,
                installment_payment_type_per: 0,
                installment_payment_type_amount: 0,
                installment_payment_type_freq: 0,
                interest_per: 0,
                interest_value: 0,
                installment_payment_type_id: null,
            },
            errors: {},
            payment_types: [],
            isCheckAll: false,
            checkAll: [],
            current_page: 1,
            setting: {
                is_fixed: true,
                ln_no: true,
                installment_payment_type_per: true,
                installment_payment_type_amount: true,
                installment_payment_type_freq: true,
                interest_per: true,
                interest_value: true,
                installment_payment_type_id: true,
            },
            is_disabled: false,
            filterSetting: [
                "is_fixed",
                "ln_no",
                "installment_payment_type_per",
                "installment_payment_type_amount",
                "installment_payment_type_freq",
                "interest_per",
                "interest_value",
            ],
            Tooltip: "",
            mouseEnter: null,
        };
    },
    validations: {
        create: {
            is_fixed: {numeric},
            ln_no: {integer},
            installment_payment_type_per: {numeric},
            installment_payment_type_amount: {numeric},
            installment_payment_type_freq: {numeric},
            interest_per: {numeric},
            interest_value: {numeric},
            installment_payment_type_id: {required},
        },
        edit: {
            is_fixed: {numeric},
            ln_no: {integer},
            installment_payment_type_per: {numeric},
            installment_payment_type_amount: {numeric},
            installment_payment_type_freq: {numeric},
            interest_per: {numeric},
            interest_value: {numeric},
            installment_payment_type_id: {required},
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
                this.planDetails.forEach((el) => {
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
        this.getData();
    },
    updated() {
        $(function () {
            $(".englishInput").keypress(function (event) {
                var ew = event.which;
                if (ew == 32) return true;
                if (48 <= ew && ew <= 57) return true;
                if (65 <= ew && ew <= 90) return true;
                if (97 <= ew && ew <= 122) return true;
                return false;
            });
            $(".arabicInput").keypress(function (event) {
                var ew = event.which;
                if (ew == 32) return true;
                if (48 <= ew && ew <= 57) return true;
                if (65 <= ew && ew <= 90) return false;
                if (97 <= ew && ew <= 122) return false;
                return true;
            });
        });
    },
    methods: {
        /**
         *  start get Data module && pagination
         */
        getData(page = 1) {
            this.isLoader = true;
            let filter = "";
            for (let i = 0; i < this.filterSetting.length; ++i) {
                filter += `columns[${i}]=${this.filterSetting[i]}&`;
            }

            adminApi
                .get(
                    `/recievable-payable/rp_installment_p_plan_details?page=${page}&per_page=${this.per_page}&search=${this.search}&${filter}`
                )
                .then((res) => {
                    let l = res.data;
                    this.planDetails = l.data;
                    this.planDetailsPagination = l.pagination;
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
                this.current_page <= this.planDetailsPagination.last_page &&
                this.current_page != this.planDetailsPagination.current_page &&
                this.current_page
            ) {
                this.isLoader = true;
                let filter = "";
                for (let i = 0; i < this.filterSetting.length; ++i) {
                    filter += `columns[${i}]=${this.filterSetting[i]}&`;
                }

                adminApi
                    .get(
                        `/recievable-payable/rp_installment_p_plan_details?page=${page}&per_page=${this.per_page}&search=${this.search}&${filter}`
                    )
                    .then((res) => {
                        let l = res.data;
                        this.planDetails = l.data;
                        this.planDetailsPagination = l.pagination;
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
         *  end get Data module && pagination
         */
        /**
         *  start delete module
         */
        deleteModule(id, index) {
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
                            .post(`/recievable-payable/rp_installment_p_plan_details/bulk-delete`, {ids: id})
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
                            .delete(`/recievable-payable/rp_installment_p_plan_details/${id}`)
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
         *  end delete module
         */
        /**
         *  reset Modal (create)
         */
        resetModalHidden() {
            this.create = {is_fixed: 0, ln_no: 0,installment_payment_type_per: 0,installment_payment_type_amount: 0,installment_payment_type_freq: 0,interest_per: 0,interest_value: 0, installment_payment_type_id: null};
            this.$nextTick(() => {
                this.$v.$reset();
            });
            this.errors = {};
            this.$bvModal.hide(`create`);
        },
        /**
         *  hidden Modal (create)
         */

        async resetModal() {
            await this.getRoleType();
            this.create = {is_fixed: 0, ln_no: 0,installment_payment_type_per: 0,installment_payment_type_amount: 0,installment_payment_type_freq: 0,interest_per: 0,interest_value: 0, installment_payment_type_id: null};
            this.$nextTick(() => {
                this.$v.$reset();
            });
            this.errors = {};
        },
        /**
         *  create module
         */
        async resetForm() {
            await this.getRoleType();
            this.create = {is_fixed: 0, ln_no: 0,installment_payment_type_per: 0,installment_payment_type_amount: 0,installment_payment_type_freq: 0,interest_per: 0,interest_value: 0, installment_payment_type_id: null};
            this.$nextTick(() => {
                this.$v.$reset();
            });
            this.is_disabled = false;
            this.errors = {};
        },

        AddSubmit() {
            this.$v.create.$touch();

            if (this.$v.create.$invalid) {
                return;
            } else {
                this.isLoader = true;
                this.errors = {};
                adminApi
                    .post(`/recievable-payable/rp_installment_p_plan_details`, this.create)
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
         *  edit module
         */
        editSubmit(id) {

            this.$v.edit.$touch();

            if (this.$v.edit.$invalid) {
                return;
            } else {
                this.isLoader = true;
                this.errors = {};
                let {is_fixed, ln_no,installment_payment_type_per,installment_payment_type_amount,installment_payment_type_freq,interest_per,interest_value, installment_payment_type_id} = this.edit;
                adminApi
                    .put(`/recievable-payable/rp_installment_p_plan_details/${id}`, {is_fixed, ln_no,installment_payment_type_per,installment_payment_type_amount,installment_payment_type_freq,interest_per,interest_value, installment_payment_type_id})
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
        async resetModalEdit(id) {
            await this.getRoleType();
            let module = this.planDetails.find((e) => id == e.id);
            this.edit.is_fixed = module.is_fixed;
            this.edit.ln_no = module.ln_no;
            this.edit.installment_payment_type_per = module.installment_payment_type_per;
            this.edit.installment_payment_type_amount = module.installment_payment_type_amount;
            this.edit.installment_payment_type_freq = module.installment_payment_type_freq;
            this.edit.interest_per = module.interest_per;
            this.edit.interest_value = module.interest_value;
            this.edit.installment_payment_type_id = module.installment_payment_type_id;
            this.errors = {};
        },
        /**
         *  hidden Modal (edit)
         */
        resetModalHiddenEdit(id) {
            this.errors = {};
            this.edit = {
                is_fixed: 0,
                ln_no: 0,
                installment_payment_type_per: 0,
                installment_payment_type_amount: 0,
                installment_payment_type_freq: 0,
                interest_per: 0,
                interest_value: 0,
                installment_payment_type_id: null,
            };
        },
        /**
         *  start  dynamicSortString
         */
        sortString(value) {
            return dynamicSortString(value);
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
        async getRoleType() {
            this.isLoader = true;

            await adminApi
                .get(`/recievable-payable/rp_installment_payment_types`)
                .then((res) => {
                    let l = res.data.data;
                    l.unshift({id: 0, name: "اضف نوع الدور", name_e: "Add Role Type"});
                    this.payment_types = l;
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
        showRoleTypeModal() {
            if (this.create.installment_payment_type_id == 0) {
                this.$bvModal.show("role-types-create");
                this.create.installment_payment_type_id = null;
            }
        },
        showRoleTypeModalEdit() {
            if (this.edit.installment_payment_type_id == 0) {
                this.$bvModal.show("role-types-create");
                this.edit.installment_payment_type_id = null;
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
                    .get(`/recievable-payable/rp_installment_p_plan_details/logs/${id}`)
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
        <PageHeader/>
        <RoleType @created="getRoleType"/>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- start search -->
                        <div class="row justify-content-between align-items-center mb-2">
                            <h4 class="header-title">{{ $t("general.InstallmentPaymentPlanDetailTable") }}</h4>
                            <div class="col-xs-10 col-md-9 col-lg-7" style="font-weight: 500">
                                <div class="d-inline-block" style="width: 22.2%">
                                    <!-- Basic dropdown -->
                                    <b-dropdown
                                        variant="primary"
                                        :text="$t('general.searchSetting')"
                                        ref="dropdown"
                                        class="btn-block setting-search"
                                    >
                                        <b-form-checkbox v-model="filterSetting" value="is_fixed" class="mb-1">
                                            {{ getCompanyKey('is_fixed') }}
                                        </b-form-checkbox>
                                        <b-form-checkbox v-model="filterSetting" value="ln_no" class="mb-1">
                                            {{ getCompanyKey('ln_no') }}
                                        </b-form-checkbox>
                                        <b-form-checkbox v-model="filterSetting" value="installment_payment_type_per" class="mb-1">
                                            {{ getCompanyKey('installment_payment_type_per') }}
                                        </b-form-checkbox>
                                        <b-form-checkbox v-model="filterSetting" value="installment_payment_type_amount" class="mb-1">
                                            {{ getCompanyKey('installment_payment_type_amount') }}
                                        </b-form-checkbox>
                                        <b-form-checkbox v-model="filterSetting" value="installment_payment_type_freq" class="mb-1">
                                            {{ getCompanyKey('installment_payment_type_freq') }}
                                        </b-form-checkbox>
                                        <b-form-checkbox v-model="filterSetting" value="interest_per" class="mb-1">
                                            {{ getCompanyKey('interest_per') }}
                                        </b-form-checkbox>
                                        <b-form-checkbox v-model="filterSetting" value="interest_value" class="mb-1">
                                            {{ getCompanyKey('interest_value') }}
                                        </b-form-checkbox>
                                        <b-form-checkbox
                                            v-model="filterSetting"
                                            :value="$i18n.locale == 'ar' ? 'installment_payment_type.name' : 'installment_payment_type.name_e'"
                                            class="mb-1"
                                        >
                                            {{ getCompanyKey('installment_payment_type_id') }}
                                        </b-form-checkbox>
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
                                        @click.prevent="deleteModule(checkAll)"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <!-- end mult delete  -->
                                    <!--  start one delete  -->
                                    <button
                                        class="custom-btn-dowonload"
                                        v-if="checkAll.length == 1"
                                        @click.prevent="deleteModule(checkAll[0])"
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
                                            <b-form-checkbox v-model="setting.is_fixed" class="mb-1"
                                            >{{ getCompanyKey('is_fixed') }}
                                            </b-form-checkbox>
                                            <b-form-checkbox v-model="setting.ln_no" class="mb-1">
                                                {{ getCompanyKey('ln_no') }}
                                            </b-form-checkbox>
                                            <b-form-checkbox v-model="setting.installment_payment_type_per" class="mb-1">
                                                {{ getCompanyKey('installment_payment_type_per') }}
                                            </b-form-checkbox>
                                            <b-form-checkbox v-model="setting.installment_payment_type_amount" class="mb-1">
                                                {{ getCompanyKey('installment_payment_type_amount') }}
                                            </b-form-checkbox>
                                            <b-form-checkbox v-model="setting.installment_payment_type_freq" class="mb-1">
                                                {{ getCompanyKey('installment_payment_type_freq') }}
                                            </b-form-checkbox>
                                            <b-form-checkbox v-model="setting.interest_per" class="mb-1">
                                                {{ getCompanyKey('interest_per') }}
                                            </b-form-checkbox>
                                            <b-form-checkbox v-model="setting.interest_value" class="mb-1">
                                                {{ getCompanyKey('interest_value') }}
                                            </b-form-checkbox>
                                            <b-form-checkbox v-model="setting.installment_payment_type_id" class="mb-1">
                                                {{ getCompanyKey('installment_payment_type_id') }}
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
                                            {{ planDetailsPagination.from }}-{{ planDetailsPagination.to }} /
                                            {{ planDetailsPagination.total }}
                                        </div>
                                        <div class="d-inline-block">
                                            <a
                                                href="javascript:void(0)"
                                                :style="{
                                                  'pointer-events':
                                                    planDetailsPagination.current_page == 1 ? 'none' : '',
                                                }"
                                                @click.prevent="getData(planDetailsPagination.current_page - 1)"
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
                                                    planDetailsPagination.last_page == planDetailsPagination.current_page
                                                      ? 'none'
                                                      : '',
                                                }"
                                                @click.prevent="getData(planDetailsPagination.current_page + 1)"
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
                            :title="getCompanyKey('InstallmentPaymentPlanDetailCreate')"
                            title-class="font-18"
                            body-class="p-4 "
                            :hide-footer="true"
                            size="lg"
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
                                            type="button"
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
                                    <!-- Emulate built in modal footer ok and cancel button actions -->

                                    <b-button
                                        variant="danger"
                                        type="button"
                                        @click.prevent="resetModalHidden"
                                    >
                                        {{ $t("general.Cancel") }}
                                    </b-button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="my-1 mr-2">{{
                                                    getCompanyKey('installment_payment_type_id')
                                                }}</label>
                                            <multiselect
                                                @input="showRoleTypeModal"
                                                v-model="create.installment_payment_type_id"
                                                :options="payment_types.map((type) => type.id)"
                                                :custom-label="(opt) => payment_types.find((x) => x.id == opt).name"
                                            >
                                            </multiselect>
                                            <template v-if="errors.installment_payment_type_id">
                                                <ErrorMessage
                                                    v-for="(errorMessage, index) in errors.installment_payment_type_id"
                                                    :key="index"
                                                >{{ errorMessage }}
                                                </ErrorMessage
                                                >
                                            </template>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-2" class="control-label">
                                                {{ getCompanyKey('ln_no') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="number"
                                                class="form-control englishInput"
                                                data-create="2"
                                                @keypress.enter="moveInput('select', 'create', 3)"
                                                v-model="$v.create.ln_no.$model"
                                                :class="{
                                                        'is-invalid': $v.create.ln_no.$error || errors.ln_no,
                                                        'is-valid': !$v.create.ln_no.$invalid && !errors.ln_no,
                                                    }"
                                                id="field-2"
                                            />
                                            <template v-if="errors.ln_no">
                                                <ErrorMessage
                                                    v-for="(errorMessage, index) in errors.ln_no"
                                                    :key="index"
                                                >{{ errorMessage }}
                                                </ErrorMessage>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-2" class="control-label">
                                                {{ getCompanyKey('installment_payment_type_per') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="number"
                                                class="form-control englishInput"
                                                step="0.01"
                                                data-create="2"
                                                @keypress.enter="moveInput('select', 'create', 3)"
                                                v-model="$v.create.installment_payment_type_per.$model"
                                                :class="{
                                                        'is-invalid': $v.create.installment_payment_type_per.$error || errors.installment_payment_type_per,
                                                        'is-valid': !$v.create.installment_payment_type_per.$invalid && !errors.installment_payment_type_per,
                                                    }"
                                            />
                                            <template v-if="errors.installment_payment_type_per">
                                                <ErrorMessage
                                                    v-for="(errorMessage, index) in errors.installment_payment_type_per"
                                                    :key="index"
                                                >{{ errorMessage }}
                                                </ErrorMessage>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-2" class="control-label">
                                                {{ getCompanyKey('installment_payment_type_amount') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="number"
                                                class="form-control englishInput"
                                                step="0.01"
                                                data-create="2"
                                                @keypress.enter="moveInput('select', 'create', 3)"
                                                v-model="$v.create.installment_payment_type_amount.$model"
                                                :class="{
                                                        'is-invalid': $v.create.installment_payment_type_amount.$error || errors.installment_payment_type_amount,
                                                        'is-valid': !$v.create.installment_payment_type_amount.$invalid && !errors.installment_payment_type_amount,
                                                    }"
                                            />
                                            <template v-if="errors.installment_payment_type_amount">
                                                <ErrorMessage
                                                    v-for="(errorMessage, index) in errors.installment_payment_type_amount"
                                                    :key="index"
                                                >{{ errorMessage }}
                                                </ErrorMessage>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-2" class="control-label">
                                                {{ getCompanyKey('installment_payment_type_freq') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="number"
                                                class="form-control englishInput"
                                                data-create="2"
                                                @keypress.enter="moveInput('select', 'create', 3)"
                                                v-model="$v.create.installment_payment_type_freq.$model"
                                                :class="{
                                                        'is-invalid': $v.create.installment_payment_type_freq.$error || errors.installment_payment_type_freq,
                                                        'is-valid': !$v.create.installment_payment_type_freq.$invalid && !errors.installment_payment_type_freq,
                                                    }"
                                            />
                                            <template v-if="errors.installment_payment_type_freq">
                                                <ErrorMessage
                                                    v-for="(errorMessage, index) in errors.installment_payment_type_freq"
                                                    :key="index"
                                                >{{ errorMessage }}
                                                </ErrorMessage>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-2" class="control-label">
                                                {{ getCompanyKey('interest_per') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                class="form-control englishInput"
                                                data-create="2"
                                                @keypress.enter="moveInput('select', 'create', 3)"
                                                v-model="$v.create.interest_per.$model"
                                                :class="{
                                                        'is-invalid': $v.create.interest_per.$error || errors.interest_per,
                                                        'is-valid': !$v.create.interest_per.$invalid && !errors.interest_per,
                                                    }"
                                            />
                                            <template v-if="errors.interest_per">
                                                <ErrorMessage
                                                    v-for="(errorMessage, index) in errors.interest_per"
                                                    :key="index"
                                                >{{ errorMessage }}
                                                </ErrorMessage>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-2" class="control-label">
                                                {{ getCompanyKey('interest_value') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                class="form-control englishInput"
                                                data-create="2"
                                                @keypress.enter="moveInput('select', 'create', 3)"
                                                v-model="$v.create.interest_value.$model"
                                                :class="{
                                                        'is-invalid': $v.create.interest_value.$error || errors.interest_value,
                                                        'is-valid': !$v.create.interest_value.$invalid && !errors.interest_value,
                                                    }"
                                            />
                                            <template v-if="errors.interest_value">
                                                <ErrorMessage
                                                    v-for="(errorMessage, index) in errors.interest_value"
                                                    :key="index"
                                                >{{ errorMessage }}
                                                </ErrorMessage>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-2">
                                                {{ getCompanyKey("is_fixed") }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select
                                                class="custom-select mr-sm-2"
                                                data-create="4"
                                                @keypress.enter.prevent="moveInput('input', 'create', 1)"
                                                v-model="$v.create.is_fixed.$model"
                                                :class="{
                                                  'is-invalid': $v.create.is_fixed.$error || errors.is_fixed,
                                                  'is-valid': !$v.create.is_fixed.$invalid && !errors.is_fixed,
                                                }"
                                            >
                                                <option value="1">{{ $t("general.predefinedDate") }}</option>
                                                <option value="0">{{ $t("general.UndefinedDate") }}</option>
                                            </select>
                                            <template v-if="errors.is_fixed">
                                                <ErrorMessage
                                                    v-for="(errorMessage, index) in errors.is_fixed"
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
                            <loader size="large" v-if="isLoader"/>
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
                                    <th v-if="setting.is_fixed">
                                        <div class="d-flex justify-content-center">
                                            <span>{{ getCompanyKey('is_fixed') }}</span>
                                            <div class="arrow-sort">
                                                <i
                                                    class="fas fa-arrow-up"
                                                    @click="planDetails.sort(sortString('is_fixed'))"
                                                ></i>
                                                <i
                                                    class="fas fa-arrow-down"
                                                    @click="planDetails.sort(sortString('-is_fixed'))"
                                                ></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th v-if="setting.ln_no">
                                        <div class="d-flex justify-content-center">
                                            <span>{{ getCompanyKey('ln_no') }}</span>
                                            <div class="arrow-sort">
                                                <i
                                                    class="fas fa-arrow-up"
                                                    @click="planDetails.sort(sortString('ln_no'))"
                                                ></i>
                                                <i
                                                    class="fas fa-arrow-down"
                                                    @click="planDetails.sort(sortString('-ln_no'))"
                                                ></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th v-if="setting.installment_payment_type_per">
                                        <div class="d-flex justify-content-center">
                                            <span>{{ getCompanyKey('installment_payment_type_per') }}</span>
                                            <div class="arrow-sort">
                                                <i
                                                    class="fas fa-arrow-up"
                                                    @click="planDetails.sort(sortString('installment_payment_type_per'))"
                                                ></i>
                                                <i
                                                    class="fas fa-arrow-down"
                                                    @click="planDetails.sort(sortString('-installment_payment_type_per'))"
                                                ></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th v-if="setting.installment_payment_type_amount">
                                        <div class="d-flex justify-content-center">
                                            <span>{{ getCompanyKey('installment_payment_type_amount') }}</span>
                                            <div class="arrow-sort">
                                                <i
                                                    class="fas fa-arrow-up"
                                                    @click="planDetails.sort(sortString('installment_payment_type_amount'))"
                                                ></i>
                                                <i
                                                    class="fas fa-arrow-down"
                                                    @click="planDetails.sort(sortString('-installment_payment_type_amount'))"
                                                ></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th v-if="setting.installment_payment_type_freq">
                                        <div class="d-flex justify-content-center">
                                            <span>{{ getCompanyKey('installment_payment_type_freq') }}</span>
                                            <div class="arrow-sort">
                                                <i
                                                    class="fas fa-arrow-up"
                                                    @click="planDetails.sort(sortString('installment_payment_type_freq'))"
                                                ></i>
                                                <i
                                                    class="fas fa-arrow-down"
                                                    @click="planDetails.sort(sortString('-installment_payment_type_freq'))"
                                                ></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th v-if="setting.interest_per">
                                        <div class="d-flex justify-content-center">
                                            <span>{{ getCompanyKey('interest_per') }}</span>
                                            <div class="arrow-sort">
                                                <i
                                                    class="fas fa-arrow-up"
                                                    @click="planDetails.sort(sortString('interest_per'))"
                                                ></i>
                                                <i
                                                    class="fas fa-arrow-down"
                                                    @click="planDetails.sort(sortString('-interest_per'))"
                                                ></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th v-if="setting.interest_value">
                                        <div class="d-flex justify-content-center">
                                            <span>{{ getCompanyKey('interest_value') }}</span>
                                            <div class="arrow-sort">
                                                <i
                                                    class="fas fa-arrow-up"
                                                    @click="planDetails.sort(sortString('interest_value'))"
                                                ></i>
                                                <i
                                                    class="fas fa-arrow-down"
                                                    @click="planDetails.sort(sortString('-interest_value'))"
                                                ></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th v-if="setting.installment_payment_type_id">{{ getCompanyKey('role_type') }}</th>
                                    <th>
                                        {{ $t("general.Action") }}
                                    </th>
                                    <th><i class="fas fa-ellipsis-v"></i></th>
                                </tr>
                                </thead>
                                <tbody v-if="planDetails.length > 0">
                                <tr
                                    @click.capture="checkRow(data.id)"
                                    @dblclick.prevent="$bvModal.show(`modal-edit-${data.id}`)"
                                    v-for="(data, index) in planDetails"
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
                                    <td v-if="setting.is_fixed">
                                            {{parseInt(data.is_fixed)  == 1? `${$t("general.predefinedDate")}`: `${$t("general.UndefinedDate")}`}}
                                    </td>
                                    <td v-if="setting.ln_no">
                                        <h5 class="m-0 font-weight-normal">{{ data.ln_no }}</h5>
                                    </td>
                                    <td v-if="setting.installment_payment_type_per">
                                        <h5 class="m-0 font-weight-normal">{{ data.installment_payment_type_per }}</h5>
                                    </td>
                                    <td v-if="setting.installment_payment_type_amount">
                                        <h5 class="m-0 font-weight-normal">{{ data.installment_payment_type_amount }}</h5>
                                    </td>
                                    <td v-if="setting.installment_payment_type_freq">
                                        <h5 class="m-0 font-weight-normal">{{ data.installment_payment_type_freq }}</h5>
                                    </td>
                                    <td v-if="setting.interest_per">
                                        <h5 class="m-0 font-weight-normal">{{ data.interest_per }}</h5>
                                    </td>
                                    <td v-if="setting.interest_value">
                                        <h5 class="m-0 font-weight-normal">{{ data.interest_value }}</h5>
                                    </td>

                                    <td v-if="setting.installment_payment_type_id">
                                        <h5 class="m-0 font-weight-normal">
                                            {{
                                                $i18n.locale == "ar" ? data.installment_payment_type.name : data.installment_payment_type.name_e
                                            }}
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
                                                    @click.prevent="deleteModule(data.id)"
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
                                            :title="getCompanyKey('InstallmentPaymentPlanDetailEdit')"
                                            title-class="font-18"
                                            body-class="p-4"
                                            :ref="`edit-${data.id}`"
                                            :hide-footer="true"
                                            size="lg"
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="my-1 mr-2">
                                                                {{ getCompanyKey('installment_payment_type_id') }}
                                                            </label>
                                                            <multiselect
                                                                @input="showRoleTypeModalEdit"
                                                                v-model="edit.installment_payment_type_id"
                                                                :options="payment_types.map((type) => type.id)"
                                                                :custom-label="
                                                                (opt) => payment_types.find((x) => x.id == opt).name
                                                              "
                                                            >
                                                            </multiselect>
                                                            <template v-if="errors.installment_payment_type_id">
                                                                <ErrorMessage
                                                                    v-for="(errorMessage, index) in errors.installment_payment_type_id"
                                                                    :key="index"
                                                                >{{ errorMessage }}
                                                                </ErrorMessage
                                                                >
                                                            </template>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="field-u-2" class="control-label">
                                                                {{ getCompanyKey('ln_no') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                                <input
                                                                    type="number"
                                                                    class="form-control englishInput"
                                                                    v-model="$v.edit.ln_no.$model"
                                                                    :class="{
                                                                      'is-invalid':
                                                                        $v.edit.ln_no.$error || errors.ln_no,
                                                                      'is-valid':
                                                                        !$v.edit.ln_no.$invalid && !errors.ln_no,
                                                                    }"
                                                                    id="field-u-2"
                                                                />
                                                            <template v-if="errors.ln_no">
                                                                <ErrorMessage
                                                                    v-for="(errorMessage, index) in errors.ln_no"
                                                                    :key="index"
                                                                >{{ errorMessage }}
                                                                </ErrorMessage>
                                                            </template>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="field-u-2" class="control-label">
                                                                {{ getCompanyKey('installment_payment_type_per') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                                <input
                                                                    type="number"
                                                                    step="0.01"
                                                                    class="form-control englishInput"
                                                                    v-model="$v.edit.installment_payment_type_per.$model"
                                                                    :class="{
                                                                      'is-invalid':
                                                                        $v.edit.installment_payment_type_per.$error || errors.installment_payment_type_per,
                                                                      'is-valid':
                                                                        !$v.edit.installment_payment_type_per.$invalid && !errors.installment_payment_type_per,
                                                                    }"
                                                                />
                                                            <template v-if="errors.installment_payment_type_per">
                                                                <ErrorMessage
                                                                    v-for="(errorMessage, index) in errors.installment_payment_type_per"
                                                                    :key="index"
                                                                >{{ errorMessage }}
                                                                </ErrorMessage>
                                                            </template>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="field-u-2" class="control-label">
                                                                {{ getCompanyKey('installment_payment_type_amount') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                                <input
                                                                    type="number"
                                                                    step="0.01"
                                                                    class="form-control englishInput"
                                                                    v-model="$v.edit.installment_payment_type_amount.$model"
                                                                    :class="{
                                                                      'is-invalid':
                                                                        $v.edit.installment_payment_type_amount.$error || errors.installment_payment_type_amount,
                                                                      'is-valid':
                                                                        !$v.edit.installment_payment_type_amount.$invalid && !errors.installment_payment_type_amount,
                                                                    }"
                                                                />
                                                            <template v-if="errors.installment_payment_type_amount">
                                                                <ErrorMessage
                                                                    v-for="(errorMessage, index) in errors.installment_payment_type_amount"
                                                                    :key="index"
                                                                >{{ errorMessage }}
                                                                </ErrorMessage>
                                                            </template>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="field-u-2" class="control-label">
                                                                {{ getCompanyKey('installment_payment_type_freq') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                                <input
                                                                    type="number"
                                                                    class="form-control englishInput"
                                                                    v-model="$v.edit.installment_payment_type_freq.$model"
                                                                    :class="{
                                                                      'is-invalid':
                                                                        $v.edit.installment_payment_type_freq.$error || errors.installment_payment_type_freq,
                                                                      'is-valid':
                                                                        !$v.edit.installment_payment_type_freq.$invalid && !errors.installment_payment_type_freq,
                                                                    }"
                                                                />
                                                            <template v-if="errors.installment_payment_type_freq">
                                                                <ErrorMessage
                                                                    v-for="(errorMessage, index) in errors.installment_payment_type_freq"
                                                                    :key="index"
                                                                >{{ errorMessage }}
                                                                </ErrorMessage>
                                                            </template>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="field-u-2" class="control-label">
                                                                {{ getCompanyKey('interest_per') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                                <input
                                                                    type="number"
                                                                    step="0.01"
                                                                    class="form-control englishInput"
                                                                    v-model="$v.edit.interest_per.$model"
                                                                    :class="{
                                                                      'is-invalid':
                                                                        $v.edit.interest_per.$error || errors.interest_per,
                                                                      'is-valid':
                                                                        !$v.edit.interest_per.$invalid && !errors.interest_per,
                                                                    }"
                                                                />
                                                            <template v-if="errors.interest_per">
                                                                <ErrorMessage
                                                                    v-for="(errorMessage, index) in errors.interest_per"
                                                                    :key="index"
                                                                >{{ errorMessage }}
                                                                </ErrorMessage>
                                                            </template>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="field-u-2" class="control-label">
                                                                {{ getCompanyKey('interest_value') }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                                <input
                                                                    type="number"
                                                                    step="0.01"
                                                                    class="form-control englishInput"
                                                                    v-model="$v.edit.interest_value.$model"
                                                                    :class="{
                                                                      'is-invalid':
                                                                        $v.edit.interest_value.$error || errors.interest_value,
                                                                      'is-valid':
                                                                        !$v.edit.interest_value.$invalid && !errors.interest_value,
                                                                    }"
                                                                />
                                                            <template v-if="errors.interest_value">
                                                                <ErrorMessage
                                                                    v-for="(errorMessage, index) in errors.interest_value"
                                                                    :key="index"
                                                                >{{ errorMessage }}
                                                                </ErrorMessage>
                                                            </template>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="mr-2">
                                                                {{ getCompanyKey("is_fixed") }}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select
                                                                class="custom-select mr-sm-2"
                                                                v-model="$v.edit.is_fixed.$model"
                                                                :class="{
                                                                  'is-invalid': $v.edit.is_fixed.$error || errors.is_fixed,
                                                                  'is-valid': !$v.edit.is_fixed.$invalid && !errors.is_fixed,
                                                                }"
                                                            >
                                                                <option value="1">{{ $t("general.predefinedDate") }}</option>
                                                                <option value="0">{{ $t("general.UndefinedDate") }}</option>
                                                            </select>
                                                            <template v-if="errors.is_fixed">
                                                                <ErrorMessage
                                                                    v-for="(errorMessage, index) in errors.is_fixed"
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
                                    <th class="text-center" colspan="11">
                                        {{ $t("general.notDataFound") }}
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end .table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
