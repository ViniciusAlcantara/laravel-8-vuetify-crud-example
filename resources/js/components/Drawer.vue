<template>
    <v-card
        height="auto"
        width="auto"
        class="mx-auto"
    >
        <v-navigation-drawer permanent>
            <v-list
                dense
                nav
            >
                <v-list-item
                    link
                    href="/estacionamentos"
                >

                    <v-list-item-action>
                        <v-icon>home</v-icon>
                    </v-list-item-action>
                    <v-list-item-title>
                        Home
                    </v-list-item-title>
                </v-list-item>
                <v-list-item
                    link
                    href="/unidades"
                >
                    <v-list-item-action>
                        <v-icon>mdi-car-info</v-icon>
                    </v-list-item-action>
                    <v-list-item-title>
                        Unidades
                    </v-list-item-title>
                </v-list-item>
                <v-list-item
                    link
                    :href="'/usuarios/'+ user.id +'/edit'"
                >
                    <v-list-item-action>
                        <v-icon>edit</v-icon>
                    </v-list-item-action>
                    <v-list-item-title>
                        Editar
                    </v-list-item-title>
                </v-list-item>
                <v-list-item
                    link
                    href="/usuario/altera-senha"
                >
                    <v-list-item-action>
                        <v-icon>security</v-icon>
                    </v-list-item-action>
                    <v-list-item-title>
                        Alterar Senha
                    </v-list-item-title>
                </v-list-item>
                <!--<v-list-item
                    link
                    href="/planos"
                >

                    <v-list-item-action>
                        <v-icon>shopping_cart</v-icon>
                    </v-list-item-action>
                    <v-list-item-title>
                        Planos
                    </v-list-item-title>
                </v-list-item>-->
            </v-list>
        </v-navigation-drawer>
    </v-card>
</template>

<script>
    export default {
        props: ['user'],
        name: "Drawer",
        data () {
            return {
            }
        },
    }
</script>

<style scoped>

</style>
