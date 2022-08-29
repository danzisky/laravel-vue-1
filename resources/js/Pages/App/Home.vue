<template>
    <Base>
        <Head title="Home" />
        <div class="grid grid-cols-1 place-content-center h-screen">
            <div class="m-auto p-16 flex flex-col items-center">
                <div>

                    <p>
                        Welcome,
                    </p>
                    <p>
                        Let's find out your personality!
                    </p>
                </div>
                <div class="m-4">
                    <button class="px-4 py-2 rounded-md bg-blue-400">
                        Start Test
                    </button>
                </div>
            </div>
        </div>
    </Base>
</template>

<script>
import Base from "./Base.vue"
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: { Base }
}
</script>

<style>

</style>