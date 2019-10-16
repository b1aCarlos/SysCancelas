<div class="ui modal modalCadastroRasp" id="modalCadastroRasp">
    <i class="close icon"></i>
    <div class="header" id="modal-title">
        Cadastro de RaspBerrys
    </div>
    <div class="content">
        <div class="ui column stackable grid">
            <form method="POST" class="ui form" id="formulario_rasp">
                <input type="hidden" id="idRasp" name="idRasp" value="">
                <div class="ui equal width grid">
                    <div class="row">
                        <div class="column">
                            <label>Nome</label>
                            <input type="text" name="nomeRasp" id="nomeRasp">
                            <span id="msg_erros" class="nomeRasp"></span>
                        </div>
                        <div class="column" id="column_ipRasp">
                            <label>IP</label>
                            <input type="text" name="ipDoRasp" id="ipDoRasp">
                            <span id="msg_erros" class="ipDoRasp"></span>
                        </div>
                        <div class="column" id="column_ip-view">
                            <label>IP</label>
                            <input type="text" name="ipDoRasp_view" id="ipDoRasp_view">
                            <span id="msg_erros" class="ipDoRasp_view"></span>
                        </div>
                        <div class="column" id="column_tipo-view">
                            <label>Tipo</label>
                            <input type="text" name="tipo_rasp_view" id="tipo_rasp_view">
                            <span id="msg_erros" class="tipo_rasp_view"></span>
                        </div>
                        <div class="column" id="column_select-tipo">
                            <label id="tipo_rasp">Tipo</label>
                            <select class="ui dropdown" id="tipoRasp" name="tipoRasp">
                                @foreach ($consultaTipo as $tipo)
                                <option value="">Selecionar tipo</option>
                                <option value="{{ $tipo->id_tipo_rasp }}">{{ $tipo->nome_tipo_rasp }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" id="row_datas">
                        <div class="column datas">
                            <label>Data de ultima atualização</label>
                            <input type="text" name="data_atualizacao" id="data_atualizacao">
                            <span id="msg_erros" class="data_atualizacao"></span>
                        </div>
                        <div class="column datas">
                            <label>Data de criação</label>
                            <input type="text" name="data_de_criacao" id="data_de_criacao">
                            <span id="msg_erros" class="data_de_criacao"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <div class="actions" id="btn_cancelar">
                                <button id="btn_cancelarr" type="button"
                                class="ui actions red deny button">Cancelar</button>
                            </div>
                            <input id="btn_limpar" type="reset" class="ui red button btn-acoes" value="Limpar">
                            <input id="adicionarRasp" type="submit" class="ui right button btn-acoes" value="Salvar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>