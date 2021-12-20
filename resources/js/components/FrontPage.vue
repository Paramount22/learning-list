<template>
    <div class="learning-app">
        <header>
            <h1>My learning list</h1>
        </header>
        <div class="container">
            <add-item-list v-on:reloadList="getItems"></add-item-list>

            <items-count :items="items.length"></items-count>

            <list-view :items="items" v-on:reloadList="getItems"></list-view>
        </div>

    </div>
</template>

<script>
    import AddItemList from "./AddItemList";
    import ListView from "./ListView";
    import ItemsCount from "./ItemsCount";
    export default {
        name: "FrontPage",
        components: {ItemsCount, ListView, AddItemList},

        data() {
            return {
                items: []
            }
        },

        created() {
            this.getItems();
        },

        methods: {
            getItems() {
                axios.get('/api/items')
                    .then(response => {
                        this.items = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        }
    }
</script>

<style lang="scss" scoped>
    header {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vh;
        background: #2c3034;
        color: white;
    }
</style>
