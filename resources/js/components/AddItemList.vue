<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <form @submit.prevent="addItem">
                    <div class="input-group mb-3 mt-4">
                        <input ref="input" type="text" class="form-control"
                               :class="[item.title ? 'is-valid' : '']"
                               name="title"
                               v-model="item.title">

                        <div class="input-group-append">
                            <button class="btn btn-success"
                                    type="submit"
                                    id="button-addon2">
                                <i class="fas fa-plus fa-2x"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div v-show="item.title" class="row justify-content-center">
            <div class="col-lg-9">
                <div id="validationFeedback" class="text-success">
                    Looks good!
                </div>
            </div>
        </div>

    </div>


</template>

<script>
    export default {
        name: "AddItemList",

        data() {
            return {
                item: {
                    title: ''
                }
            }
        },
        mounted() {
           this.$refs.input.focus()

        },

        methods: {
            addItem() {
                if( ! this.item.title ) return;

                axios.post('api/item/store', {
                    item: this.item
                })
                    .then(response => {
                        if(response.status === 200) {
                            this.item.title = '';
                            this.$emit('reloadList');
                            this.$root.$emit('flash', 'New item added to list.');
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

        }
    }
</script>

<style lang="scss" scoped>
    input {
        font-size: 1.8rem;
        font-weight: bold;
        background: white;
        &:active, &:focus {
            background: white;
        }
    }
    .is-danger {
        border: 1px solid red;
    }
    button {
        font-size: 1.5rem;
        border-radius: 0 0.25rem  .25rem 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #validationFeedback {
        font-size: 1.3rem;
        font-weight: bold;
        position: relative;
        bottom: .6rem;
    }

</style>
