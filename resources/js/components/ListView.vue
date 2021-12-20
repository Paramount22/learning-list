<template>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <transition-group name="bounce" tag="ul" class="list-group mt-4">
                    <list-item
                        v-for="item in items"
                        :key="item.id"
                        :item="item"
                        v-on:itemChanged="$emit('reloadList')"
                    ></list-item>
                </transition-group>
            </div>
        </div>



</template>

<script>
    import ListItem from "./ListItem";
    export default {
        name: "ListView",
        props: ['items'],
        components: {ListItem}
    }
</script>

<style lang="scss" scoped>
    .bounce-enter-active {
        animation: bounce-in .5s;
    }
    .bounce-leave-active {
        animation: bounce-in .5s reverse;
    }
    @keyframes bounce-in {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
        }
    }
</style>
