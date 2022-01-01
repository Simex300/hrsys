import Employees from '../components/Employee/PageEmployees.vue';
import EmployeeDetails from '../components/Employee/PageEmployeeDetails.vue';

export default [
    {
        path: '/employee',
        name: 'employee',
        component: Employees,
        meta: {
            middleware: 'auth'
        }
    },
    {
        path: '/employee/:id',
        name: 'employeeDetails',
        component: EmployeeDetails,
        meta: {
            middleware: 'auth'
        }
    },
]
