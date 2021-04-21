<template>
     <div>
         <v-row
             align="center"
         >
             <v-col cols="12">
                 <v-autocomplete name="fk_estacionamento" :items="estacionamentos" v-model="estacionamento" label="Estacionamento"
                                 clearable clear-icon="close" item-text="nome" item-value="id"
                 >
                 </v-autocomplete>
             </v-col>
         </v-row>
         <v-row align="center">
             <v-col cols="6">
                 <v-text-field v-model="descricao" name="descricao" id="descricao" :counter="100"
                               placeholder="Descrição"></v-text-field>
             </v-col>
             <v-col cols="3">
                 <v-text-field
                     label="Área da Vaga"
                     value="2.00"
                     v-model="area"
                     name="area"
                     id="area"
                 ></v-text-field>
             </v-col>
             <v-col cols="3">
                 <v-text-field
                     label="Número da Unidade"
                     value="28.00"
                     v-model="numero"
                     name="numero"
                     id="numero"
                 ></v-text-field>
             </v-col>
         </v-row>
         <!--<v-row>
             <input type="hidden" name="em_uso" :value="em_uso">
             <v-switch v-model="em_uso" label="Unidade ocupada?"></v-switch>
         </v-row>-->
     </div>
</template>

<script>
    export default {
        props: ['estacionamentos', 'unidade', 'user'],
        name: "UnidadesForm",
        data: () => ({
            estacionamento: null,
            descricao: null,
            em_uso: false,
            area: null,
            numero: null,
        }),
        mounted() {
            if (this.unidade) {
                console.log(this.unidade.fk_estacionamento);
                this.estacionamento = parseInt(this.unidade.fk_estacionamento)
                this.descricao = this.unidade.descricao
                this.em_uso = this.unidade.em_uso
                this.area = this.unidade.area
                this.numero = this.unidade.numero
            }
        },
        methods: {
            onKeyDown(evt){
                if (evt.target.value.length >= 2 && evt.keyCode != 8 && evt.keyCode != 9) {
                    evt.preventDefault()
                    return false
                }
                return true
            }
        }
    }
</script>

<style scoped>

</style>
