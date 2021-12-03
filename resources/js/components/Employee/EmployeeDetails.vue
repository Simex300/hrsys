<template>
    <div class="employee-details">
        <div class="employee-details__header">
            <div class="employee-details__header__profile">
                <img v-if="employee.profile" class="card__image" :src="`./storage/${employee.profile}`" alt="...">
                <img v-else class="card__image" src="https://via.placeholder.com/80" alt="...">
            </div>
            <div class="employee-details__header__name">{{employee.first_name}} {{employee.middle_name}} {{employee.last_name}}</div>
            <div class="employee-details__header__extra">Some extra details</div>
            <div class="employee-details__header__options actions">
                <button class="actions__add">
                    <i class="fas fa-file-contract"></i>
                </button>
                <button class="actions__add">
                    <i class="fas fa-user-plus"></i>
                </button>
            </div>
        </div>
        <div class="employee-details__body">
            <div class="employee-details__body__achievements">
                <h2 class="title">Achievements</h2>
                <ul class="achievement-list">
                    <li class="achievement-item">Attendance Streak <span class="achievement-value">100 / 100%</span></li>
                    <li class="achievement-item">Total Sales <span class="achievement-value"> 10</span></li>
                    <li class="achievement-item">Highest Sale <span class="achievement-value">15,000$</span></li>
                </ul>
            </div>
            <div class="employee-details__body__calendar">
                <h2 class="title">Work Calendar</h2>
                <CalendarHeatmap class="calendar" :values="[{date: '2021-12-02', count: 1}]" end-date="2021-12-31" tooltip-unit="Hours Worked" />
            </div>
        </div>
    </div>
</template>
<script>
import { CalendarHeatmap } from 'vue-calendar-heatmap';
export default {
    components: {
        CalendarHeatmap
    },
    props: {
        employee: Object,
    }
}
</script>
