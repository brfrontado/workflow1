<template>
    <CRow>
        <CCol :xs="12">
            <CCard class="mb-4">
                <CCardHeader>
                    <strong>Canales de usuarios</strong>
                    <button @click="$router.push('/usuarios/canal/edit/0')" class="btn btn-primary float-end">Crear nuevo canal</button>
                </CCardHeader>
                <CCardBody>
                    <div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Buscar por</label>
                            <div class="row">
                                <div class="col-3">
                                    <select class="form-select" v-model="typeSearch">
                                        <option value="nombre">Nombre</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="text" v-model="searchValue" class="form-control" placeholder="Escribe aquí tu búsqueda">
                                </div>
                            </div>
                        </div>
                    </div>
                    <EasyDataTable :headers="headers" :items="items" :search-field="typeSearch" :search-value="searchValue" alternating >
                        <template #item-operation="item">
                            <div>
                                <i class="fas fa-pencil icon me-3" @click="editItem(item)"></i>
                                <i class="fas fa-trash icon" @click="deleteItem(item)"></i>
                            </div>
                        </template>
                    </EasyDataTable>

                </CCardBody>
            </CCard>
        </CCol>
    </CRow>
</template>

<script>
import toolbox from "@/toolbox";

export default {
    name: 'Tables',
    data() {
        return {
            typeSearch: 'nombre',
            searchValue: '',
            headers: [
                {text: "Nombre de canal", value: "nombre"},
                {text: "Activo", value: "activo"},
                {text: "Operación", value: "operation"},
            ],
            items: []
        };
    },
    mounted() {
        this.getItems();
    },
    methods: {
        getItems() {

            const self = this;
            toolbox.doAjax('GET', 'users/canal/list', {},
                function (response) {
                    //self.items = response.data;
                    self.items = toolbox.prepareForTable(response.data);
                    //console.log(self.items);
                },
                function (response) {
                    toolbox.alert(response.msg, 'danger');
                })
        },
        deleteItem(item) {
            const self = this;
            toolbox.confirm('Se eliminará este canal de usuarios, ¿desea continuar?', function () {
                toolbox.doAjax('POST', 'users/canal/delete', {
                        id: item.id,
                    },
                    function (response) {
                        toolbox.alert(response.msg, 'success');
                        self.getItems();
                    },
                    function (response) {
                        toolbox.alert(response.msg, 'danger');
                    })
            })
        },
        editItem(item) {
            this.$router.push('/usuarios/canal/edit/' + item.id);
        }
    }
}
</script>
