<template>
    <div>
        <li class="list-group-item d-flex justify-content-between align-items-center shadow">
            <div class="form-check d-flex align-items-center">
                <input type="checkbox" class="form-check-input"
                       @change="updateCheck"
                       v-model="item.completed">
            </div>

            <span class="course-title" :class="[item.completed ? 'completed' : '']">
                {{item.title}}
            </span>
            <div>
                <button @click="showEdit" class="text-warning pen">
                    <i v-show="showPen"  class="fas fa-pen"></i>
                </button>

                <button @click="removeItem" class="trash text-danger">
                    <i class="fas fa-trash"></i>
                </button>

            </div>

        </li>
        <span v-if="visible"
              class="edit-container mb-3 d-flex justify-content-between align-items-center">
           <input class="form-control edit-input" type="text" :id="[item.id]"
                v-model="item.title" @keydown.esc="hideEdit" @keydown.enter="updateItem" autofocus>
            <i @click="hideEdit" class="fas fa-times fa-2x"></i>
        </span>


    </div>

    
</template>

<script>
    export default {
        name: "ListItem",
        props: ['item'],
        data() {
            return {
                visible: false,
                showPen: true
            }
        },


        methods: {

            showEdit()      {
                this.visible = true;
                this.showPen = false;

            },

            hideEdit() {
                this.visible = false;
                this.showPen = true;
            },

            updateCheck() {
                axios.put('api/item/' + this.item.id, {
                    item: this.item
                })
                    .then(response => {
                        if (response.status === 200) {
                            this.$emit('itemChanged');
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            updateItem() {
                axios.put('api/item/update/' + this.item.id, {
                    item: this.item
                })
                    .then(response => {
                        if (response.status === 200) {
                            this.$emit('itemChanged');
                            this.$root.$emit('flash', 'Item updated.');
                            this.visible = false;
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            removeItem() {
                axios.delete('api/item/' + this.item.id)
                    .then( response => {
                        if(response.status === 200) {
                            this.$emit('itemChanged');
                            this.$root.$emit('flash', 'Item deleted.');
                        }
                    })
                    .catch( error => {
                        console.log(error)
                    })
            },


        }
    }
</script>

<style lang="scss" scoped>
    li {
        font-size: 1.6rem;
        font-weight: bold;
        margin-bottom: 1.5rem;

    }
    .edit-input {
        font-size: 1.3rem;
        font-weight: bold;
        background: white;
        color: #6c757d;
        &:focus {
            color: black;
        }
    }

    .trash, .pen {
        background: white;
        border: none;
        outline: none;
        cursor: pointer;
        transition: all .2s ease;
    }

    .fa-times {
        margin-left: .5rem;
        cursor: pointer;
        position: relative;
        bottom: 3px;
        color: #6c757d;

        &:hover {
            color: #dc3545;
        }

    }


    .fa-trash:hover {
        color: darken(#dc3545, 10%);
    }
     .fa-pen:hover {
         color: darken(#ffc107, 5%);
     }

    .completed {
        opacity: .3;
        text-decoration: line-through;
    }

    .bounce-enter-active {
        animation: bounce-in .3s;
    }
    .bounce-leave-active {
        animation: bounce-in .3s reverse;
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
