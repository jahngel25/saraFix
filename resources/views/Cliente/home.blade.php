@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 3%">
        @foreach($dataOrdenServicio as $value)
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" style="border-color: #c3c3c3; background-color: #ffdada; ">
                    <div class="row" style="padding: 3%">
                        <div class="col-md-1 col-xs-1">
                            <i class="fa fa-check-square-o fa-4x" aria-hidden="true" ></i>
                        </div><div class="col-md-1 col-xs-1">
                            <h4 class="product-name"><strong><span id="lblText_0">{{$value->description}}</span></strong></h4>
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="col-md-3 col-xs-4 text-center">
                                <h4><strong><span id="lblPrecio_0">{{$value->date}}</span></strong></h4>
                            </div>
                            <div class="col-md-3 col-xs-4 text-center">
                                <h4><strong><span id="lblPrecio_0">${{$value->total}} Pesos</span></strong></h4>
                            </div>
                            <div class="col-md-3 col-xs-4 text-center" style="padding-top: 2%;">
                                <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-3 col-xs-4" align="right" style="padding-top: 2%;">
                                <input type="hidden" name="pago_{{$value->id}}" value="{{$value->id}}">
                                <form>
                                    <script src='https://checkout.epayco.co/checkout.js'
                                            data-epayco-key='0e642f31a1dbbbcf86658b978956999e'
                                            class='epayco-button'
                                            data-epayco-amount='{{$value->total}}'
                                            data-epayco-tax='0'
                                            data-epayco-tax-base='{{$value->total}}'
                                            data-epayco-name='Servicios'
                                            data-epayco-description='Servicios'
                                            data-epayco-currency='COP'
                                            data-epayco-country='CO'
                                            data-epayco-test='true'
                                            data-epayco-external='false'
                                            data-epayco-response=''
                                            data-epayco-confirmation=''
                                            data-epayco-button='https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/boton_carro_de_compras_epayco6.png'>
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@section('contentScript')
    <script>
        function generarPagoPayCo(costos){

            var handler = ePayco.checkout.configure({
                key: '45b960805ced5c27ce34b1600b4b9f54',
                test: true
            })

            var data={
                //Parametros compra (obligatorio)
                name: "Vestido Mujer Primavera",
                description: "Vestido Mujer Primavera",
                invoice: "1234",
                currency: "cop",
                amount: costos,
                tax_base: "0",
                tax: "0",
                country: "co",
                lang: "en",
                //Onpage="false" - Standard="true"
                external: "true",
                //Atributos opcionales
                extra1: "extra1",
                extra2: "extra2",
                extra3: "extra3",
                confirmation: "http://secure2.payco.co/prueba_curl.php",
                response: "http://secure2.payco.co/prueba_curl.php",
                //Atributos cliente
                name_billing: "Andres Perez",
                address_billing: "Carrera 19 numero 14 91",
                type_doc_billing: "cc",
                mobilephone_billing: "3050000000",
                number_doc_billing: "100000000"
            }
            handler.open(data);
        }

    </script>
@endsection
