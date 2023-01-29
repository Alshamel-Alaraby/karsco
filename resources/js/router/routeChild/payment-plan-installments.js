import auth from "../../middleware/auth";
import checkAuth from "../../middleware/auth-check";

export default [
    {
        path: '/dashboard/payment-plan-installments',
        name: 'payment-plan-installments',
        meta: {
            middleware: [auth,checkAuth]
        },
        component: () => import('../../views/pages/payment_plan_installments/index'),
    },
];
