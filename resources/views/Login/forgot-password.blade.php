@extends('Layout.login')

@section('formulario-resetar-senha')
<div class="ui container">
    <div class="ui grid">
        <div class="ui grid row centered">
            <div class="ui grid column six wide ">
                <Form>
                    <div class="ui form row linhaForm" id="linhaForm" style="margin-bottom: 3%;">
                        <input type="email" name="email" placeholder="E-mail">
                     </div>
                    <div class="ui form row">
                        <button type="submit" class="ui fluid button" style="background-color: transparent; color:white;  border: 1px solid white; ">
                            <font style="vertical-align: inherit;">Enviar um link para resetar sua senha</font>
                        </button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</div>
@endsection