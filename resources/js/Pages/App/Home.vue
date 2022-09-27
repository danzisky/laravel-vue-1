<template>
    <Head title="Home" />
    <div class="grid grid-cols-1 place-content-center h-screen">
        <div class="m-auto px-16 py-8 flex flex-col items-center text-2xl bg-slate-200 rounded-lg shadow-2xl">
            <div class="uppercase font-mono_ font-semibold text-gray-500">

                <p>
                    Welcome,
                </p>
                <p>
                    Let's find out your personality!
                </p>
            </div>
            <div class="mt-6">
                <KeepAlive>
                    <NavLink :href="route('test')" :active="route().current('test')" class="h-full">
                        <SubmitButton :buttonText="'Start Test'" :canSubmit="true" class="shadow-xl_">
                            Start Test
                        </SubmitButton>
                    </NavLink>
                </KeepAlive>
            </div>
        </div>
    </div>
</template>

<script>
import Base from "./Base.vue"
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from '@inertiajs/inertia-vue3';
import SubmitButton from "./Components/SubmitButton.vue";
import NavLink from "../../Components/NavLink.vue";

export default {
    layout: Base,
    components: {
    Base,
    Link,
    Head,
    SubmitButton,
    NavLink
}
}
</script>

<style>

</style>