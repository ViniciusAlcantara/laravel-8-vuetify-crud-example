<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * @property integer $id
 * @property int $fk_estacionamento
 * @property string $area
 * @property string $numero
 * @property string $descricao
 * @property boolean $em_uso
 * @property string $created_at
 * @property string $updated_at
 */
class Unidades extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['fk_estacionamento', 'area', 'numero', 'descricao', 'em_uso'];


    const rules = [
        'descricao' => 'required',
        'numero' => 'required',
        'area' => 'required',
        'fk_estacionamento' => 'required',
    ];

    const messages = [
        'descricao.required' => 'Descrição é obrigatório',
        'numero.required' => 'Número é obrigatório',
        'area.required' => 'Área é obrigatório',
        'fk_estacionamento.required' => 'O estacionamento é obrigatório',
    ];

    public static function _validate($data)
    {
        return Validator::make($data, self::rules, self::messages);
    }

    static function validate ($data)
    {
        return self::_validate($data);
    }

}
