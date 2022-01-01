// import Employees from './components/Employee/Employees.vue';
// import AddEmployee from './components/Employee/AddEmployee.vue';
// import UpdateEmployee from './components/Employee/UpdateEmployee.vue';

// TODO: Remove when not needed
import Dashboard from '../components/Dashboard.vue';
import Page from '../components/Test/Page.vue';
// Routes
import auth from './auth';
import employee from './employee';

export const routes = [
    {
        path: '/',
        name: 'home',
        component: Dashboard,
        meta: {
            middleware: 'auth',
            title: `Home`
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
//         path: '/spa-page',
//         name: 'page',
//         component: Page,
//         props: {
//             title: "This is the SPA Second Page",
//             author: {
//                 name: "Adonis Almonte",
//                 role: "Software Dev",
//                 code: "Always keep it clean"
//             }
//         }
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
