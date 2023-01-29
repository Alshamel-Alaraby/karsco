import auth from "../../middleware/auth";
import checkAuth from "../../middleware/auth-check";

export default [
    {
        path: '/dashboard/installment-status',
        name: 'installmentStatus',
        meta: {
            middleware: [auth,checkAuth]
        },
        component: () => import('../../views/pages/recievablePayable/installmentStatus'),
    },
    {
        path: '/dashboard/installment-payment-type',
        name: 'installmentPaymentType',
        meta: {
            middleware: [auth,checkAuth]
        },
        component: () => import('../../views/pages/recievablePayable/InstallmentPaymentType'),
    },
    {
        path: '/dashboard/MainContactGroups',
        name: 'MainContactGroups',
        meta: {
            middleware: [auth,checkAuth]
        },
        component: () => import('../../views/pages/recievablePayable/MainContactGroups'),
    },
    {
        path: '/dashboard/InstallmentPaymentPlanDetail',
        name: 'InstallmentPaymentPlanDetail',
        meta: {
            middleware: [auth,checkAuth]
        },
        component: () => import('../../views/pages/recievablePayable/InstallmentPaymentPlanDetail'),
    },
    {
        path: '/dashboard/installment-payment-plan',
        name: 'installment-payment-plan',
        meta: {
            middleware: [auth,checkAuth]
        },
        component: () => import('../../views/pages/recievablePayable/InstallmentPaymentPlan'),
    },
];
