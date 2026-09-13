<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlogtable extends Migration
{
    public function up()
    {
     $this->forge->addField([
'id'=>[
'type' =>'int',
'constraint'=>11,
'unsigned' =>true,
'auto_increment' => true,
],
'user_id' => [
    'type'=>'int',
    'constraint' =>'11',
    'unsigned' => true,
],
'author' =>[
'type' => 'VARCHAR',
'constraint' => '100'
],

'content' =>[
    'type' =>'text'
],
'created_at' =>[
'type' =>'datetime',
'null' => true,
]
     ]);
    
    $this->forge->addkey('id',true);
    $this->forge->addForeignKey('user_id', 'users', 'id');
    $this->forge->createTable('blogs');
    }



    public function down()
    {
      $this->forge->dropTable('blogs');  
    }
}
