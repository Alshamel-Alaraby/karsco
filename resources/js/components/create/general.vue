<template>
    <div>
        <employee :companyKeys="companyKeys" :defaultsKeys="defaultsKeys" @created="$emit('created')" />
        <customerGeneral :companyKeys="companyKeys" :defaultsKeys="defaultsKeys" @created="$emit('created')" />
        <country :companyKeys="companyKeys" :defaultsKeys="defaultsKeys" :id="'country-create-general'" @created="$emit('created')" />
        <city :companyKeys="companyKeys" :defaultsKeys="defaultsKeys" :id="'city-create-general'" @created="$emit('created')" />
        <propertyTree :companyKeys="companyKeys" :defaultsKeys="defaultsKeys" @created="$emit('created')" />
    </div>
</template>

<script>
import employee from "../../components/create/employee.vue";
import customerGeneral from "../../components/create/customerGeneral";
import country from "../../components/country";
import city from "../../components/city";
import propertyTree from "./property-tree"
import Layout from "../../views/layouts/main";
import PageHeader from "../Page-header";
import Switches from "vue-switches";
import ErrorMessage from "../widgets/errorMessage";
import loader from "../loader";
import Multiselect from "vue-multiselect";

export default {
    name: "general",
    components: {
        Layout,
        PageHeader,
        Switches,
        ErrorMessage,
        loader,
        Multiselect,
        employee,
        customerGeneral,
        propertyTree,
        country,
        city
    },
    
    props:[
        "currentNode",
        "companyKeys",
        "defaultsKeys"
    ],
    methods:{

    }
}
</script>

<style scoped>

</style>
