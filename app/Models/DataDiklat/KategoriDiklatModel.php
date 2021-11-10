<?php namespace App\Models\DataDiklat;
use CodeIgniter\Model;

class KategoriDiklatModel extends Model
{
    protected $table              = 'sipgan_kategori_diklat';
    protected $primaryKey         = 'id';
    protected $useSoftDeletes     = false;
    protected $returnType         = 'array';
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    //SHOW COLUMNS FROM ;
    protected $allowedFields      = [
        'kode',
        'nama',
        'jam_pelajaran',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function get($id=false)
    {
        if($id === false)
        {
            return $this->findAll();
        }
        else
        {
            return $this->where($id)->find();
        }
    }
}