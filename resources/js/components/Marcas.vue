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
        <modal-component id="modalMarca" titulo="Adicionar marca"></modal-component>
        <!-- end modal -->
    </div>
</template>

<script>

</script>
