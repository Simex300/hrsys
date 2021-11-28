import Employees from '../components/Employee/Employees.vue';

export default [
    {
        path: '/employee',
        name: 'employee',
        component: Employees,
        meta: {
            middleware: 'auth'
        }
    }
]
