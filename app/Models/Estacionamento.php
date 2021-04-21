<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * @property integer $id
 * @property string $nome
 * @property string $endereco
 * @property string $cidade
 * @property string $estado
 * @property string $fk_usuario
 * @property string $created_at
 * @property string $updated_at
 */
class Estacionamento extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estacionamentos';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'endereco', 'cidade', 'cnpj', 'estado', 'fk_usuario', 'created_at', 'updated_at'];

    const rules = [
        'nome' => 'required',
        'endereco' => 'required',
        'cidade' => 'required',
        'estado' => 'required',
        'fk_usuario' => 'required',
        'cnpj' => 'required | unique:estacionamentos'
    ];

    const messages = [
        'nome.required' => 'Nome do estacionamento é obrigatório',
        'endereco.required' => 'Endereço é obrigatório',
        'cidade.required' => 'Cidade é obrigatório',
        'estado.required' => 'Estado é obrigatório',
        'fk_usuario.required' => 'Administrador do estacionamento é obrigatório',
        'cnpj.unique' => 'Já existe outro estacionamento cadastrado com esse cnpj'
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
