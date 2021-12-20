<template>
    <p>Items: {{items}} </p>
</template>

<script>
    export default {
        name: "ItemsCount",
        props: ['items']
    }
</script>

<style scoped>
    p {
        font-size: 1.3rem;
        font-weight: bold;
    }
</style>
