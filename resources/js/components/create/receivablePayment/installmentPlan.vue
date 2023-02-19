<script>
import adminApi from "../../../api/adminAxios";
import Switches from "vue-switches";
import { required, minLength, maxLength, integer } from "vuelidate/lib/validators";
import Swal from "sweetalert2";
import ErrorMessage from "../../../components/widgets/errorMessage";
import loader from "../../../components/loader";
import { dynamicSortString } from "../../../helper/tableSort";
import { formatDateOnly, formatDateTime } from "../../../helper/startDate";
import transMixinComp from "../../../helper/translation-comp-mixin";
import DatePicker from "vue2-datepicker";
import Multiselect from "vue-multiselect";
import InstallmentPaymentType from "./installmentPaymentType.vue";
import {arabicValue, englishValue} from "../../../helper/langTransform";

// require styles
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
/**
 * Advanced Table component
 */
export default {
  mixins: [transMixinComp],
  components: {
    Switches,
    ErrorMessage,
    loader,
    DatePicker,
    Multiselect,
    InstallmentPaymentType,
  },
  data() {
    return {
      editorOption: {
        // Some Quill options...
        theme: "snow",
        modules: {
          toolbar: [
            [
              {
                font: [],
              },
              {
                size: [],
              },
            ],
            ["bold", "italic", "underline", "strike"],
            [
              {
                color: [],
              },
              {
                background: [],
              },
            ],
            [
              {
                script: "super",
              },
              {
                script: "sub",
              },
            ],
            [
              {
                header: [false, 1, 2, 3, 4, 5, 6],
              },
              "blockquote",
              "code-block",
            ],
            [
              {
                list: "ordered",
              },
              {
                list: "bullet",
              },
              {
                indent: "-1",
              },
              {
                indent: "+1",
              },
            ],
            [
              "direction",
              {
                align: [],
              },
            ],
            ["link", "image", "video"],
            ["clean"],
          ],
        },
      },
      debounce: {},
      enabled3: false,
      isLoader: false,
      paymentTypes: [],
      create: {
        name: "",
        name_e: "",
        description: "",
        description_e: "",
        start_date: "",
        installment_payment_type_id: null,
        is_default: 1,
        is_active: "active",
      },
      errors: {},
      custom_date_start: new Date(),
      dropDownSenders: [],
      is_disabled: false,
      isCheckAll: false,
      checkAll: [],
    };
  },
  validations: {
    create: {
      name: { required, minLength: minLength(3), maxLength: maxLength(100) },
      name_e: { required, minLength: minLength(3), maxLength: maxLength(100) },
      description: { maxLength: maxLength(1000) },
      description_e: { maxLength: maxLength(1000) },
      is_default: { required },
      is_active: { required },
      start_date: { required },
      installment_payment_type_id: { required },
    },
  },

  updated() {
    // $(function () {
    //   $(".englishInput").keypress(function (event) {
    //     var ew = event.which;
    //     if (ew == 32) return true;
    //     if (48 <= ew && ew <= 57) return true;
    //     if (65 <= ew && ew <= 90) return true;
    //     if (97 <= ew && ew <= 122) return true;
    //     return false;
    //   });
    //   $(".arabicInput").keypress(function (event) {
    //     var ew = event.which;
    //     if (ew == 32) return true;
    //     if (48 <= ew && ew <= 57) return true;
    //     if (65 <= ew && ew <= 90) return false;
    //     if (97 <= ew && ew <= 122) return false;
    //     return true;
    //   });
    // });
  },
   props:["companyKeys","defaultsKeys"],

  methods: {
    showInstallPaymentTypeModal() {
      if (this.create.installment_payment_type_id == 0) {
        this.$bvModal.show("installment_payment_type_create");
        this.create.installment_payment_type_id = null;
      }
    },
    async getInstallPaymentTypes() {
      this.isLoader = true;
      await adminApi
        .get(`recievable-payable/rp_installment_payment_types`)
        .then((res) => {
          let l = res.data.data;
          l.unshift({
            id: 0,
            name: "اضف نوع دفع جديد",
            name_e: "Add installment payment type",
          });
          this.paymentTypes = l;
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

    resetModalHidden() {
      this.create = {
        name: "",
        name_e: "",
        description: "",
        description_e: "",
        start_date: formatDateTime(this.custom_date_start),
        installment_payment_type_id: null,
        is_default: 1,
        is_active: "active",
      };
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.errors = {};
      this.$bvModal.hide(`installment-payment-plan-create`);
    },
    /**
     *  hidden Modal (create)
     */
    async resetModal() {
      this.create = {
        name: "",
        name_e: "",
        description: "",
        description_e: "",
        start_date: formatDateTime(this.custom_date_start),
        installment_payment_type_id: null,
        is_default: 1,
        is_active: "active",
      };
      await this.getInstallPaymentTypes();
      this.custom_date_start = new Date();
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.errors = {};
    },
    /**
     *  create module
     */
    resetForm() {
      this.create = {
        name: "",
        name_e: "",
        description: "",
        description_e: "",
        start_date: formatDateTime(this.custom_date_start),
        installment_payment_type_id: null,
        is_default: 1,
        is_active: "active",
      };
      this.custom_date_start = new Date();
      this.$nextTick(() => {
        this.$v.$reset();
      });
      this.is_disabled = false;
      this.errors = {};
    },
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
          .post(`/recievable-payable/rp_installment_p_plan`, {
            ...this.create,
            is_active: this.create.is_active == "active" ? 1 : 0,
          })
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
    start_date(e) {
      if (e) {
        this.create.start_date = formatDateTime(e);
      } else {
        this.create.start_date = null;
      }
    },
    moveInput(tag, c, index) {
      document.querySelector(`${tag}[data-${c}='${index}']`).focus();
    },
    formatDate(value) {
      return formatDateOnly(value);
    },
      arabicValue(txt){
          this.create.name = arabicValue(txt);
      },
      arabicValueDescription(txt){
          this.create.description = arabicValue(txt);
      },
      englishValue(txt){
          this.create.name_e = englishValue(txt);
      },
      englishValueDescription(txt){
          this.create.description_e = englishValue(txt);
      },
  },
};
</script>

<template>
  <div>
    <InstallmentPaymentType
      :companyKeys="companyKeys"
      :defaultsKeys="defaultsKeys"
      @created="getInstallPaymentTypes"
    />
    <!--  create   -->
    <b-modal
      id="installment-payment-plan-create"
      :title="getCompanyKey('installment_payment_plan_create')"
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
        <div class="row">
          <div class="col-md-6">
            <div class="form-group position-relative">
              <label class="control-label">
                {{ getCompanyKey("installment_payment_type") }}
                <span class="text-danger">*</span>
              </label>
              <multiselect
                @input="showInstallPaymentTypeModal"
                v-model="create.installment_payment_type_id"
                :options="paymentTypes.map((type) => type.id)"
                :custom-label="
                  (opt) =>
                    $i18n.locale == 'ar'
                      ? paymentTypes.find((x) => x.id == opt).name
                      : paymentTypes.find((x) => x.id == opt).name_e
                "
              >
              </multiselect>
              <div
                v-if="
                  $v.create.installment_payment_type_id.$error ||
                  errors.installment_payment_type_id
                "
                class="text-danger"
              >
                {{ $t("general.fieldIsRequired") }}
              </div>
              <template v-if="errors.installment_payment_type_id">
                <ErrorMessage
                  v-for="(errorMessage, index) in errors.installment_payment_type_id"
                  :key="index"
                  >{{ errorMessage }}</ErrorMessage
                >
              </template>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="field-1" class="control-label">
                {{ getCompanyKey("installment_payment_name_ar") }}
                <span class="text-danger">*</span>
              </label>
              <div dir="rtl">
                <input
                  type="text"
                  class="form-control arabicInput"
                  data-create="1"
                  @keypress.enter="moveInput('input', 'create', 2)"
                  v-model="$v.create.name.$model"
                  :class="{
                    'is-invalid': $v.create.name.$error || errors.name,
                    'is-valid': !$v.create.name.$invalid && !errors.name,
                  }"
                  @keyup="arabicValue(create.name)"
                  id="field-1"
                />
              </div>
              <div v-if="!$v.create.name.minLength" class="invalid-feedback">
                {{ $t("general.Itmustbeatleast") }}
                {{ $v.create.name.$params.minLength.min }}
                {{ $t("general.letters") }}
              </div>
              <div v-if="!$v.create.name.maxLength" class="invalid-feedback">
                {{ $t("general.Itmustbeatmost") }}
                {{ $v.create.name.$params.maxLength.max }}
                {{ $t("general.letters") }}
              </div>
              <template v-if="errors.name">
                <ErrorMessage v-for="(errorMessage, index) in errors.name" :key="index">
                  {{ errorMessage }}
                </ErrorMessage>
              </template>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="field-2" class="control-label">
                {{ getCompanyKey("installment_payment_name_en") }}
                <span class="text-danger">*</span>
              </label>
              <div>
                <input
                  type="text"
                  class="form-control englishInput"
                  data-create="2"
                  @keypress.enter="moveInput('select', 'create', 3)"
                  v-model="$v.create.name_e.$model"
                  :class="{
                    'is-invalid': $v.create.name_e.$error || errors.name_e,
                    'is-valid': !$v.create.name_e.$invalid && !errors.name_e,
                  }"
                  @keyup="englishValue(create.name_e)"
                  id="field-2"
                />
              </div>
              <div v-if="!$v.create.name_e.minLength" class="invalid-feedback">
                {{ $t("general.Itmustbeatleast") }}
                {{ $v.create.name_e.$params.minLength.min }}
                {{ $t("general.letters") }}
              </div>
              <div v-if="!$v.create.name_e.maxLength" class="invalid-feedback">
                {{ $t("general.Itmustbeatmost") }}
                {{ $v.create.name_e.$params.maxLength.max }}
                {{ $t("general.letters") }}
              </div>
              <template v-if="errors.name_e">
                <ErrorMessage v-for="(errorMessage, index) in errors.name_e" :key="index"
                  >{{ errorMessage }}
                </ErrorMessage>
              </template>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">
                {{ getCompanyKey("installment_payment_start_date") }}
                <span class="text-danger">*</span>
              </label>
              <date-picker
                v-model="custom_date_start"
                type="datetime"
                :default-value="custom_date_start"
                @change="start_date"
                confirm
              ></date-picker>
              <div v-if="!$v.create.start_date.required" class="invalid-feedback">
                {{ $t("general.fieldIsRequired") }}
              </div>
              <template v-if="errors.start_date">
                <ErrorMessage
                  v-for="(errorMessage, index) in errors.start_date"
                  :key="index"
                  >{{ errorMessage }}</ErrorMessage
                >
              </template>
            </div>
          </div>
             <div class="col-md-6">
                    <div class="form-group">
                      <label class="mr-2">
                        {{ getCompanyKey("is_default") }}
                        <span class="text-danger">*</span>
                      </label>
                      <b-form-group
                        :class="{
                          'is-invalid': $v.create.is_default.$error || errors.is_default,
                          'is-valid':
                            !$v.create.is_default.$invalid && !errors.is_default,
                        }"
                      >
                        <b-form-radio
                          class="d-inline-block"
                          v-model="$v.create.is_default.$model"
                          name="some-radios__create"
                          value="1"
                          >{{ $t("general.Yes") }}</b-form-radio
                        >
                        <b-form-radio
                          class="d-inline-block m-1"
                          v-model="$v.create.is_default.$model"
                          name="some-radios__create"
                          value="0"
                          >{{ $t("general.No") }}</b-form-radio
                        >
                      </b-form-group>
                      <template v-if="errors.is_default">
                        <ErrorMessage
                          v-for="(errorMessage, index) in errors.is_default"
                          :key="index"
                          >{{ errorMessage }}</ErrorMessage
                        >
                      </template>
                    </div>
                  </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="mr-2">
                {{ getCompanyKey("is_active") }}
                <span class="text-danger">*</span>
              </label>
              <b-form-group
                :class="{
                  'is-invalid': $v.create.is_active.$error || errors.is_active,
                  'is-valid': !$v.create.is_active.$invalid && !errors.is_active,
                }"
              >
                <b-form-radio
                  class="d-inline-block"
                  v-model="$v.create.is_active.$model"
                  name="some-radios"
                  value="active"
                  >{{ $t("general.Active") }}</b-form-radio
                >
                <b-form-radio
                  class="d-inline-block m-1"
                  v-model="$v.create.is_active.$model"
                  name="some-radios"
                  value="inactive"
                  >{{ $t("general.Inactive") }}</b-form-radio
                >
              </b-form-group>
              <template v-if="errors.is_active">
                <ErrorMessage
                  v-for="(errorMessage, index) in errors.is_active"
                  :key="index"
                  >{{ errorMessage }}
                </ErrorMessage>
              </template>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="mr-2">
                {{ getCompanyKey("installment_payment_description_ar") }}
                <span class="text-danger">*</span>
              </label>
              <quill-editor
                v-model="$v.create.description.$model"
                style="min-height: 150px; background-color: #fff"
                :options="editorOption"
                @keyup="arabicValueDescription(create.description)"
              />
              <template v-if="errors.description">
                <ErrorMessage
                  v-for="(errorMessage, index) in errors.description"
                  :key="index"
                  >{{ errorMessage }}</ErrorMessage
                >
              </template>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="mr-2">
                {{ getCompanyKey("installment_payment_description_en") }}
                <span class="text-danger">*</span>
              </label>
              <quill-editor
                v-model="$v.create.description_e.$model"
                style="min-height: 150px; background-color: #fff"
                :options="editorOption"
                @keyup="englishValueDescription(create.description_e)"
              />
              <template v-if="errors.description_e">
                <ErrorMessage
                  v-for="(errorMessage, index) in errors.description_e"
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
  </div>
</template>
