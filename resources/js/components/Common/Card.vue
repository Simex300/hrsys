<template>
    <div :class="{'card': true, 'selected': data.selected}">
        <img src="https://via.placeholder.com/80" class="card__image" alt="...">
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
        title: String,
        body: String,
        footer: String,
    }
}
</script>
