<template>
    <v-system-bar
        color="white"
        class="elevation-5"
        height="50px"
    >
        <v-breadcrumbs :items="items"></v-breadcrumbs>
    </v-system-bar>
</template>

<script>
export default {
    props: {
        links: String
    },
    data: () => ({
        items: [
            {
                text: "Dashboard",
                disabled: false,
                href: "/"
            }
        ]
    }),
    mounted: function(){
        if(this.links != ''){
            const data = JSON.parse(this.links)
            this.items.push(data)
        }
    }
}
</script>

<style>

</style>