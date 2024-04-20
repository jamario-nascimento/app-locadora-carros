<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <card-component titulo="Busca de marcas">
                        <template v-slot:conteudo>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input-container-component titulo="ID" id="inputId" id-help="idHelp"
                                        texto-ajuda="Opcional. Informe o ID da marca">

                                        <input type="number" class="form-control" id="inputId" aria-describedby="idHelp"
                                            placeholder="ID">

                                    </input-container-component>


                                </div>
                                <div class="col-md-6 mb-3">
                                    <input-container-component titulo="Nome" id="inputNome" id-help="nomeHelp"
                                        texto-ajuda="Opcional. Informe o nome da marca">

                                        <input type="text" class="form-control" id="inputNome"
                                            aria-describedby="nomeHelp" placeholder="Nome da marca">

                                    </input-container-component>
                                </div>
                            </div>
                        </template>

                        <template v-slot:rodape>
                            <button type="submit" class="btn btn-primary btn-sm float-right">Pesquisar</button>
                        </template>
                    </card-component>
                </div>

                <!-- inicio card listagem de marcas -->
                <card-component titulo="Listagem de marcas">

                    <template v-slot:conteudo>
                        <div class="row">
                            <table-component></table-component>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="buton" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                            data-bs-target="#modalMarca">Adicionar</button>
                    </template>

                </card-component>
                <!-- final listagem de marcas -->
            </div>
        </div>

        <!-- Modal -->
        <modal-component id="modalMarca" titulo="Adicionar marca">
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Nome da Marca" id="novoNome" id-help="novoNomeHelp"
                        texto-ajuda="Informe o nome da marca">

                        <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp"
                            placeholder="Nome da Marca" v-model="nomeMarca">
                    </input-container-component>
                    {{ nomeMarca }}
                </div>
                <div class="form-group">
                    <input-container-component titulo="Imagem" id="novoImagem" id-help="novoImagemHelp"
                        texto-ajuda="Seleciona uma imagem no formato png">

                        <input type="file" class="form-control" id="novoImagem" aria-describedby="novoImagemHelp"
                            placeholder="Selecione uma imagem" @change="carregarImagem($event)">

                    </input-container-component>
                    {{ arquivoImagem }}
                </div>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
            </template>

        </modal-component>
        <!-- end modal -->
    </div>
</template>

<script>
  export default {
        data() {
            return {
                urlBase: 'http://localhost:8000/api/v1/marca',
                nomeMarca: '',
                arquivoImagem: []
            }
        },
        methods: {
            carregarImagem(e) {
                this.arquivoImagem = e.target.files
            },
            salvar() {
                console.log(this.nomeMarca, this.arquivoImagem[0])

                let formData = new FormData();
                formData.append('nome', this.nomeMarca)
                formData.append('imagem', this.arquivoImagem[0])

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json'
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        console.log(response)
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            }
        }
    }
</script>
