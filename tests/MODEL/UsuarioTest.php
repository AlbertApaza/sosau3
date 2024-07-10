<?php
namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Usuario;

class UsuarioTest extends TestCase {

    public function testLogin()
{
    $usuario = new Usuario();
    $result = $usuario->login('jesus', '123'); // Reemplaza con tus datos válidos
    
    var_dump($result); // Verifica qué está devolviendo el método login
    
    $this->assertNotNull($result); // Asegúrate de que el resultado no sea null
    $this->assertArrayHasKey('usuario', $result); // Asegúrate de que el resultado tenga la clave 'usuario'
}
}
?>
