<template>
    <div :class="{'card': true, 'selected': data.selected}">
        <img v-if="profile" class="card__image" :src="`./storage/${profile}`" alt="...">
        <img v-else class="card__image" src="https://via.placeholder.com/80" alt="...">
        <div class="card__container">
            <h5 class="card__container__title">{{ title }}</h5>
            <p class="card__container__body">Relevant information goes here</p>
            <p class="card__container__footer">Absence time: 0</p>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        data: Object,
        profile: String,
        title: String,
        body: String,
        footer: String,
    }
}
</script>
