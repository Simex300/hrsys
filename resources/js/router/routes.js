// import Employees from './components/Employee/Employees.vue';
// import AddEmployee from './components/Employee/AddEmployee.vue';
// import UpdateEmployee from './components/Employee/UpdateEmployee.vue';

// TODO: Remove when not needed
import ExampleComponent from '../components/ExampleComponent.vue';
import Employee from '../components/Employee/Employees.vue';
import Page from '../components/Test/Page.vue';
// Routes
import auth from './auth';
import employee from './employee';

export const routes = [
    {
        path: '/',
        name: 'home',
        component: Employee,
        meta: {
            middleware: 'auth'
        }
    },
    {
        path: '/spa-page',
        name: 'page',
        component: Page,
        props: {
            title: "This is the SPA Second Page",
            author: {
                name: "Adonis Almonte",
                role: "Software Dev",
                code: "Always keep it clean"
            }
        }
    },
    ...auth,
    ...employee
];

// End Test
// export const routes = [{
//         name: 'home',
//         path: '/',
//         component: Employees
//     },
//     {
//         name: 'add',
//         path: '/add',
//         component: AddEmployee
//     },
//     {
//         name: 'edit',
//         path: '/edit/:id',
//         component: UpdateEmployee
//     }
// ];
