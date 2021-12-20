<template>
    <transition name="fade">
        <div class="alert alert-success" role="alert" v-if="visible">
            {{message}}
        </div>
    </transition>

</template>

<script>
    export default {
        name: "FlashMessage",

        data() {
            return {
                visible: false,
                message: ''
            }
        },
        created() {
            this.message = this.text;
            this.$root.$on('flash', message => {
                this.message = message;
                this.showFlash();
            });
        },

        methods: {
            showFlash() {
                this.visible = true;
                setTimeout(()=> this.hideFlash(), 3000)
            },

            hideFlash() {
                this.visible = false
            }
        }
    }
</script>

<style lang="scss" scoped>
    .alert {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        font-size:  1.3rem;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .35s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
