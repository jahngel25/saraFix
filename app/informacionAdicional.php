<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class informacionAdicional extends Model
{
    protected $table = 'informacion_adicional';
    protected $fillable = [
                            'id',
                            'identificacion',
                            'fecha_nacimiento',
                            'img_foto',
                            'direccion',
                            'transporte',
                            'documento_doc',
                            'certificado_doc',
                            'bachiller_doc',
                            'eps_doc',
                            'experiencia',
                            'perfil',
                            'id_user',
                            'id_tipo_documento',
                            'id_ciudad'
                          ];
    protected $guarded = ['id'];

}
