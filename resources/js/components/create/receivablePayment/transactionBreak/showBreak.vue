<script>
import adminApi from "../../../../api/adminAxios";
import Switches from "vue-switches";
import {required, minLength, maxLength} from "vuelidate/lib/validators";
import Swal from "sweetalert2";
import ErrorMessage from "../../../widgets/errorMessage";
import loader from "../../../loader";
import transMixinComp from "../../../../helper/translation-comp-mixin";
import Multiselect from "vue-multiselect";
import InstallmentPaymentType from "../installmentPaymentType.vue";
import InstallmentStatus from "../installmentStatus";
import DatePicker from "vue2-datepicker";

/**
 * Advanced Table component
 */
export default {
    mixins: [transMixinComp],
    components: {
        Switches,
        ErrorMessage,
        loader,
        Multiselect,
        DatePicker,
        InstallmentPaymentType,
        InstallmentStatus
    },
    props: ["companyKeys", "defaultsKeys", "opening"],

    data() {
        return {
            isLoader: false,
            create: [],
            errors: {},
            dropDownSenders: [],
            customers: [],
            currencies: [],
            payment_types: [],
            installment_statuses: [],
            is_disabled: false,
            isCheckAll: false,
            checkAll: [],
            current_page: 1,
            enabled3: true,
            printLoading: true,
            isDebit: true,
            repeat:0,
            totalOpening: 0,
            totalDivision: 0,
            residual: 0,
            printObj: {
                id: "printCustom",
            },
        };
    },
    validations: {
        create: {
            $each: {
                opening_balance_id: {required},
                instalment_date: {required},
                rate: {required},
                instalment_type_id: {required},
                customer_id: {required},
                currency_id: {required},
                document_id: {required},
                debit: {},
                credit: {},
                repate: {required},
                total: {},
                terms: {},
                installment_statu_id: {required},
                details: {required},
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
            }, 400);
        },
        /**
         * watch check All table
         */
        isCheckAll(after, befour) {
            if (after) {
                this.conditions.forEach((el) => {
                    if (!this.checkAll.includes(el.id)) {
                        this.checkAll.push(el.id);
                    }
                });
            } else {
                this.checkAll = [];
            }
        },
        opening(after, befour) {
            this.resetModal();
        },
    },
    methods: {
        showInstallmentPaymentTypeModal(index) {
            if (this.create[index].instalment_type_id == 0) {
                this.$bvModal.show("installment_payment_type_create");
                this.create[index].instalment_type_id = null;
            } else {
                let payment = this.payment_types.find((x) => x.id == this.create[index].instalment_type_id);
                this.create[index].repate = payment.freq_period;
                this.calcBreak(index);
            }
        },
        showInstallmentStatusModal(index) {
            if (this.create[index].installment_statu_id == 0) {
                this.$bvModal.show("installment-payment-create");
                this.create[index].installment_statu_id = null;
            }
        },
        /**
         *  get customer
         */
        async getCustomers() {
            this.isLoader = true;
            await adminApi
                .get(`/general-customer`)
                .then((res) => {
                    this.isLoader = false;
                    let l = res.data.data;
                    l.unshift({id: 0, name: "اضافة زبون", name_e: "Add customer"});
                    this.customers = l;
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
         *  get currency
         */
        async getCurrencies() {
            this.isLoader = true;

            await adminApi
                .get(
                    `/currencies`
                )
                .then((res) => {
                    let l = res.data.data;
                    l.unshift({id: 0, name: "اضف عمله جديده  ", name_e: "Add New Currency"});
                    this.currencies = l;
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

        async getInstallPaymentTypes() {
            this.isLoader = true;

            await adminApi
                .get(`/recievable-payable/rp_installment_payment_types`)
                .then((res) => {
                    let l = res.data.data;
                    l.unshift({
                        id: 0,
                        name: "اضف نوع دفع",
                        name_e: "Add installment payment type",
                    });
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

        async getInstallmentStatuses() {
            this.isLoader = true;
            await adminApi
                .get(`recievable-payable/rp_installment_status`)
                .then((res) => {
                    this.isLoader = false;
                    let l = res.data.data;
                    l.unshift({
                        id: 0,
                        name: "اضف حالة الدفع",
                        name_e: "Add installment payment status",
                    });
                    this.installment_statuses = l;
                })
                .catch((err) => {
                    Swal.fire({
                        icon: "error",
                        title: `${this.$t("general.Error")}`,
                        text: `${this.$t("general.Thereisanerrorinthesystem")}`,
                    });
                });
        },

        addNewFieldCreate() {
            let data = this.opening;
            this.create.push({
                instalment_date: data.instalment_date,
                rate: data.rate,
                currency_id: data.currency_id,
                customer_id: data.customer_id,
                opening_balance_id: data.id,
                instalment_type_id: data.instalment_type_id,
                document_id: null,
                debit: 0,
                credit: 0,
                repate: 1,
                total: 0,
                terms: '',
                installment_statu_id: 1,
                details: '',

            });
        },
        removeNewFieldCreate(index) {
            if (this.create.length > 1) {
                this.create.splice(index, 1);
            }

            this.totalDivision = 0;

            this.create.forEach((el) => {
                this.totalDivision += parseFloat(el.credit);
            });

            this.create.forEach((el) => {
                this.totalDivision += parseFloat(el.debit);
            });

            this.residual = this.totalOpening - this.totalDivision;
        },

        resetModalHidden() {
            this.create = [];
            this.$nextTick(() => {
                this.$v.$reset();
            });
            this.errors = {};
            this.$bvModal.hide(`opening-balance-break-create-show`);
        },
        /**
         *  hidden Modal (create)
         */
        async resetModal() {
            this.isLoader = true;
            let data = this.opening;
            console.log(data);
            await this.getCustomers();
            await this.getCurrencies();
            await this.getInstallPaymentTypes();
            await this.getInstallmentStatuses();
            if (data.credit > 0) {
                this.isDebit = false;
                this.totalOpening = data.credit;
                this.totalDivision = data.credit;
            } else {
                this.isDebit = true;
                this.totalOpening = data.debit;
                this.totalDivision = data.debit;
            }
            this.repeat = data.repate;
            this.create.push({
                instalment_date: data.instalment_date,
                rate: data.rate,
                currency_id: data.currency_id,
                customer_id: data.customer_id,
                opening_balance_id: data.id,
                instalment_type_id: data.instalment_type_id,
                document_id: null,
                debit: data.debit > 0 ? data.debit : 0,
                credit: data.credit > 0 ? data.credit : 0 ,
                repate: 1,
                total: this.totalOpening,
                terms: '',
                installment_statu_id: 1,
                details: '',

            });
            this.isLoader = false;
            this.$nextTick(() => {
                this.$v.$reset();
            });
            this.errors = {};
        },
        /**
         *  create module
         */
        AddSubmit() {
            if (!this.create.name) {
                this.create.name = this.create.name_e;
            }
            if (!this.create.name_e) {
                this.create.name_e = this.create.name;
            }
            this.$v.create.$touch();

            if (this.$v.create.$invalid) {
                return;
            } else {
                this.isLoader = true;
                this.errors = {};
                adminApi
                    .post(`/recievable-payable/rp_installment_condation`, this.create)
                    .then((res) => {
                        this.is_disabled = true;
                        this.$emit("created");
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
        calcBreak(index) {
            this.totalDivision = 0;
            this.calcTotal(index);
            if (!this.isDebit) {
                this.calcTotal(index);
                this.create.forEach((el) => {
                    this.totalDivision += parseFloat(el.total);
                });
                this.residual = this.totalOpening - this.totalDivision;
            } else {
                this.create.forEach((el) => {
                    this.totalDivision += parseFloat(el.total);
                });
                this.residual = this.totalOpening - this.totalDivision;
            }
        },
        calcTotal(index) {
            let repate = this.create[index].repate;
            if (this.create[index].repate) {
                if (!this.isDebit) {
                    this.create[index].total = this.create[index].credit * repate;
                } else {
                    this.create[index].total = this.create[index].debit * repate;
                }
            }
        }
    },
};
</script>

<template>
    <dev>
        <InstallmentPaymentType :companyKeys="companyKeys" :defaultsKeys="defaultsKeys"
                                @created="getInstallPaymentTypes"/>
        <InstallmentStatus :companyKeys="companyKeys" :defaultsKeys="defaultsKeys" @created="getInstallmentStatuses"/>
        <!--  create   -->
        <b-modal
            id="opening-balance-break-create-show"
            :title="$t('general.ShowBreak')"
            title-class="font-18"
            body-class="p-4 "
            dialog-class="modal-full-width"
            scrollable
            :hide-footer="true"
            @hidden="resetModalHidden"
        >
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        {{ $t('general.totalAmount') }}
                                    </label>
                                    <input
                                        :disabled="true"
                                        type="number"
                                        class="form-control"
                                        step="any"
                                        v-model="totalOpening"
                                    />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        {{ $t('general.totalDivision') }}
                                    </label>
                                    <input
                                        :disabled="true"
                                        type="number"
                                        class="form-control"
                                        step="any"
                                        v-model="totalDivision"
                                    />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        {{ $t('general.Residual') }}
                                    </label>
                                    <input
                                        :disabled="true"
                                        type="number"
                                        class="form-control"
                                        step="any"
                                        v-model="residual"
                                    />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">
                                        {{ $t('general.repeat') }}
                                    </label>
                                    <input
                                        :disabled="true"
                                        type="number"
                                        class="form-control"
                                        step="any"
                                        v-model="repeat"
                                    />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-end">
                        <template v-if="!is_disabled && residual == 0">
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

                        <b-button variant="danger" type="button" @click.prevent="resetModalHidden">
                            {{ $t("general.Cancel") }}
                        </b-button>
                    </div>
                </div>

                <template v-for="(item, index) in create">
                    <div class="row" v-if="index == 0">
                        <div class="col-md-1">
                            <div class="form-group position-relative">
                                <label v-if="index == 0" class="control-label">
                                    {{ getCompanyKey('installment_opening_balance_currency') }}
                                </label>
                                <multiselect
                                    :disabled="true"
                                    v-model="$v.create.$each[index].currency_id.$model"
                                    :options="currencies.map((type) => type.id)"
                                    :custom-label="(opt) => $i18n.locale == 'ar' ?currencies.find((x) => x.id == opt).name:currencies.find((x) => x.id == opt).name_e"
                                    :class="{
                                    'is-invalid': $v.create.$each[index].currency_id.$error || errors.currency_id,
                                    'is-valid': !$v.create.$each[index].currency_id.$invalid && !errors.currency_id,
                                  }"
                                >
                                </multiselect>
                                <template v-if="errors.currency_id">
                                    <ErrorMessage
                                        v-for="(errorMessage, index) in errors.currency_id"
                                        :key="index"
                                    >{{ errorMessage }}
                                    </ErrorMessage
                                    >
                                </template>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label v-if="index == 0" class="control-label">
                                    {{ getCompanyKey('installment_opening_balance_rate') }}
                                </label>
                                <input
                                    :disabled="true"
                                    type="number"
                                    class="form-control"
                                    step="any"
                                    v-model="$v.create.$each[index].rate.$model"
                                    :class="{
                                    'is-invalid': $v.create.$each[index].rate.$error || errors.rate,
                                    'is-valid': !$v.create.$each[index].rate.$invalid && !errors.rate,
                                  }"
                                />
                                <template v-if="errors.rate">
                                    <ErrorMessage
                                        v-for="(errorMessage, index) in errors.rate"
                                        :key="index"
                                    >{{ errorMessage }}
                                    </ErrorMessage
                                    >
                                </template>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group position-relative">
                                <label v-if="index == 0"
                                       class="control-label">{{ getCompanyKey("customer") }}
                                </label>
                                <multiselect
                                    :disabled="true"
                                    v-model="$v.create.$each[index].customer_id.$model"
                                    :options="customers.map((type) => type.id)"
                                    :custom-label="(opt) => $i18n.locale == 'ar' ?customers.find((x) => x.id == opt).name:customers.find((x) => x.id == opt).name_e"
                                    :class="{
                                        'is-invalid': $v.create.$each[index].customer_id.$error || errors.customer_id ,
                                        'is-valid': !$v.create.$each[index].customer_id.$invalid && !errors.customer_id,
                                      }"
                                >
                                </multiselect>

                                <template v-if="errors.customer_id">
                                    <ErrorMessage
                                        v-for="(errorMessage, index) in errors.customer_id"
                                        :key="index"
                                    >{{ errorMessage }}
                                    </ErrorMessage
                                    >
                                </template>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label v-if="index == 0"
                                       class="control-label">{{ getCompanyKey("installment_payment_type_id") }}</label>
                                <multiselect
                                    :disabled="true"
                                    @input="showInstallmentPaymentTypeModal(index)"
                                    v-model="create[index].instalment_type_id"
                                    :options="payment_types.map((type) => type.id)"
                                    :custom-label="
                                      (opt) =>
                                        $i18n.locale == 'ar'
                                          ? payment_types.find((x) => x.id == opt).name
                                          : payment_types.find((x) => x.id == opt).name_e
                                    "
                                >
                                </multiselect>
                                <div
                                    v-if="!$v.create.$each[index].instalment_type_id.required"
                                    class="invalid-feedback"
                                >
                                    {{ $t("general.fieldIsRequired") }}
                                </div>
                                <template v-if="errors.instalment_type_id">
                                    <ErrorMessage
                                        v-for="(
                                        errorMessage, index
                                      ) in errors.instalment_type_id"
                                        :key="index"
                                    >{{ errorMessage }}
                                    </ErrorMessage>
                                </template>
                            </div>
                        </div>
                    </div>
                    <dev class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label v-if="index == 0" class="control-label" style="font-size: 12px">
                                    {{ $t('general.debit') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input
                                    :disabled="!isDebit"
                                    type="number"
                                    step="any"
                                    class="form-control arabicInput"
                                    data-create="3"
                                    @input="calcBreak(index)"
                                    v-model="$v.create.$each[index].debit.$model"
                                    :class="{
                                        'is-invalid': $v.create.$each[index].debit.$error || errors.debit,
                                        'is-valid': !$v.create.$each[index].debit.$invalid && !errors.debit,
                                      }"
                                />
                                <template v-if="errors.debit">
                                    <ErrorMessage
                                        v-for="(errorMessage, index) in errors.debit"
                                        :key="index"
                                    >{{ errorMessage }}
                                    </ErrorMessage
                                    >
                                </template>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label v-if="index == 0" class="control-label" style="font-size: 12px">
                                    {{ $t('general.credit') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input
                                    :disabled="isDebit"
                                    type="number"
                                    step="any"
                                    class="form-control"
                                    @input="calcBreak(index)"
                                    data-create="3"
                                    v-model="$v.create.$each[index].credit.$model"
                                    :class="{
                                    'is-invalid': $v.create.$each[index].credit.$error || errors.credit,
                                    'is-valid': !$v.create.$each[index].credit.$invalid && !errors.credit,
                                  }"
                                />
                                <template v-if="errors.credit">
                                    <ErrorMessage
                                        v-for="(errorMessage, index) in errors.credit"
                                        :key="index"
                                    >{{ errorMessage }}
                                    </ErrorMessage
                                    >
                                </template>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label v-if="index == 0" class="control-label">
                                    {{ getCompanyKey('installment_opening_balance_date') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <date-picker
                                    type="date"
                                    v-model="$v.create.$each[index].instalment_date.$model"
                                    format="YYYY-MM-DD"
                                    valueType="format"
                                    :confirm="false"
                                    :class="{ 'is-invalid':
                                            $v.create.$each[index].instalment_date.$error ||
                                            errors.instalment_date,
                                        'is-valid':
                                            !$v.create.$each[index].instalment_date
                                                .$invalid &&
                                            !errors.instalment_date,
                                    }"
                                ></date-picker>
                                <template v-if="errors.instalment_date">
                                    <ErrorMessage v-for="(errorMessage,index) in errors.instalment_date"
                                                  :key="index">
                                        {{ errorMessage }}
                                    </ErrorMessage>
                                </template>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label v-if="index == 0" class="control-label" style="font-size: 12px">
                                    {{ $t('general.Total') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input
                                    :disabled="true"
                                    type="number"
                                    class="form-control"
                                    data-create="3"
                                    v-model="$v.create.$each[index].total.$model"
                                    :class="{
                                    'is-invalid': $v.create.$each[index].total.$error || errors.total,
                                    'is-valid': !$v.create.$each[index].total.$invalid && !errors.total,
                                  }"
                                />
                                <template v-if="errors.total">
                                    <ErrorMessage
                                        v-for="(errorMessage, index) in errors.total"
                                        :key="index"
                                    >{{ errorMessage }}
                                    </ErrorMessage
                                    >
                                </template>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label v-if="index == 0" class="control-label" style="font-size: 12px">
                                    {{ $t('general.details') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="$v.create.$each[index].details.$model"
                                    :class="{
                                    'is-invalid': $v.create.$each[index].details.$error || errors.details,
                                    'is-valid': !$v.create.$each[index].details.$invalid && !errors.details,
                                  }"
                                />
                                <template v-if="errors.details">
                                    <ErrorMessage
                                        v-for="(errorMessage, index) in errors.details"
                                        :key="index"
                                    >{{ errorMessage }}
                                    </ErrorMessage
                                    >
                                </template>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label v-if="index == 0">{{ $t('general.status') }}</label>
                                <multiselect
                                    @input="showInstallmentStatusModal(index)"
                                    v-model="create[index].installment_statu_id"
                                    :options="installment_statuses.map((type) => type.id)"
                                    :custom-label="
                                          (opt) =>
                                            $i18n.locale == 'ar'
                                              ? installment_statuses.find((x) => x.id == opt).name
                                              : installment_statuses.find((x) => x.id == opt).name_e
                                        "
                                >
                                </multiselect>
                                <div
                                    v-if="!$v.create.$each[index].installment_statu_id.required"
                                    class="invalid-feedback"
                                >
                                    {{ $t("general.fieldIsRequired") }}
                                </div>

                                <template v-if="errors.installment_statu_id">
                                    <ErrorMessage
                                        v-for="(errorMessage, index) in errors.installment_statu_id"
                                        :key="index"
                                    >{{ errorMessage }}
                                    </ErrorMessage
                                    >
                                </template>
                            </div>
                        </div>

                        <div :class="[index == 0 ? ' pt-3':'' ,'col-md-1']">
                            <button v-if="create.length > 1"
                                    type="button"
                                    @click.prevent="removeNewFieldCreate(index)"
                                    class="custom-btn-dowonload"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <b-button :disabled="residual > 0 ? false : true"
                                      variant="success"
                                      @click.prevent="addNewFieldCreate"
                                      type="button" :class="['font-weight-bold px-2']"
                            >
                                <i class="fas fa-plus"></i>
                            </b-button>
                        </div>
                    </dev>
                </template>
            </form>
        </b-modal>
        <!--  /create   -->
    </dev>

</template>
