<template>
    <div class="employee-details-page">
        <div class="employee-details-page__header">
            <div class="employee-details-page__header__profile">
                <img v-if="employee.profile" class="card__image" :src="`${this.api_url}/storage/${this.employee.profile}`" alt="...">
                <img v-else class="card__image" src="https://via.placeholder.com/80" alt="...">
            </div>
            <div class="employee-details-page__header__name">{{this.employee.first_name}} {{this.employee.middle_name}} {{this.employee.last_name}}</div>
            <div class="employee-details-page__header__extra">{{this.employee.role}} - {{this.employee.department}}</div>
            <div class="employee-details-page__header__options actions">
                <button class="actions__add">
                    <i class="fas fa-user-plus"></i>
                </button>
            </div>
        </div>
        <div class="employee-details-page__body">
            <Tab :tabs="tabs">
                <template v-slot:tabPanel-0>
                    <div class="employee-details-page__body__information">
                        <ul>
                            <li v-if="employee.address"><span>Address:</span>{{employee.address.address1}} {{employee.address.address2}} {{employee.address.city}} {{employee.address.state}} {{employee.address.country}} {{employee.address.zipcode}}</li>
                            <li><span>Date of birth:</span>{{employee.date_of_birth}}</li>
                            <li><span>Gender:</span>{{employee.gender}}</li>
                            <li><span>Salary:</span>{{employee.salary}}</li>
                            <li><span>Salary Rate:</span>{{employee.salary_rate}}</li>
                        </ul>
                    </div>
                </template>
                <template v-slot:tabPanel-1><DumpPage index="2"/></template>
                <template v-slot:tabPanel-2>
                    <v-calendar
                        class="custom-calendar max-w-full"
                        :masks="calendar.masks"
                        :attributes="calendar.attributes"
                        disable-page-swipe
                        is-expanded
                    >
                        <template v-slot:day-content="{day, attributes}">
                            <div class="day-card">
                                <span class="day-card__day">{{ day.day }}</span>
                                <div class="day-card__card">
                                    <p
                                        v-for="attr in attributes"
                                        :key="attr.key"
                                        class="day-card__card__text"
                                        :class="attr.customData.class"
                                    >
                                    {{ attr.customData.title }}
                                    </p>
                                </div>
                            </div>
                        </template>
                    </v-calendar>
                </template>
            </Tab>
        </div>
    </div>
</template>
<script>
import Tab from '../Common/Tab.vue';
import DumpPage from '../Test/DumpPage';

export default {
    components: {
        Tab, DumpPage
    },
    mounted() {
        axios.get(`${process.env.MIX_APP_URL}/api/employees/${this.$route.params.id}`).then((response) => {
            this.employee = response.data;
            document.title = `${this.employee.first_name} ${this.employee.middle_name[0]} ${this.employee.last_name}`;
        });
    },
    data() {
        const month = new Date().getMonth();
        const year = new Date().getFullYear();
        return {
            api_url: process.env.MIX_APP_URL,
            tabs: ["Information", "Reports", "Calendar"],
            employee: {},
            calendar: {
                masks: {
                    weekdays: 'WWW'
                },
                attributes: [
                    {
                        key: 1,
                        customData: {
                            title: 'Lunch with mom.',
                            class: 'bg-red-600 text-white',
                        },
                        dates: new Date(year, month, 1),
                    },
                    {
                        key: 2,
                        customData: {
                            title: 'Take Noah to basketball practice',
                            class: 'bg-blue-500 text-white',
                        },
                        dates: new Date(year, month, 2),
                    },
                    {
                        key: 3,
                        customData: {
                            title: "Noah's basketball game.",
                            class: 'bg-blue-500 text-white',
                        },
                        dates: new Date(year, month, 5),
                    },
                    {
                        key: 4,
                        customData: {
                            title: 'Take car to the shop',
                            class: 'bg-indigo-500 text-white',
                        },
                        dates: new Date(year, month, 5),
                    },
                    {
                        key: 4,
                        customData: {
                            title: 'Meeting with new client.',
                            class: 'bg-teal-500 text-white',
                        },
                        dates: new Date(year, month, 7),
                    },
                    {
                        key: 5,
                        customData: {
                            title: "Mia's gymnastics practice.",
                            class: 'bg-pink-500 text-white',
                        },
                        dates: new Date(year, month, 11),
                    },
                    {
                        key: 6,
                        customData: {
                            title: 'Cookout with friends.',
                            class: 'bg-orange-500 text-white',
                        },
                        dates: { months: 5, ordinalWeekdays: { 2: 1 } },
                    },
                    {
                        key: 7,
                        customData: {
                            title: "Mia's gymnastics recital.",
                            class: 'bg-pink-500 text-white',
                        },
                        dates: new Date(year, month, 22),
                    },
                    {
                        key: 8,
                        customData: {
                            title: 'Visit great grandma.',
                            class: 'bg-red-600 text-white',
                        },
                        dates: new Date(year, month, 25),
                    },
                ],
            }
        }
    }
}
</script>
