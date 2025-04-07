<?php

class AttackPokemon{

    private float $attackMinimal;
    private float $attackMaximal;
    private float $specialAttack;
    private float $probabilySpecialAttack;

    public function __construct($attackMinimal,$attackMaximal,$specialAttack,$probabilySpecialAttack){
        $this->attackMinimal = $attackMinimal;
        $this->attackMaximal = $attackMaximal;
        $this->specialAttack = $specialAttack;
        $this->probabilySpecialAttack = $probabilySpecialAttack;
    }

    public function getAttackMinimal(){
        return $this->attackMinimal;
    }

    public function getAttackMaximal(){
        return $this->attackMaximal;
    }

    public function getSpecialAttack(){
        return $this->specialAttack;
    }
    
    public function getProbabilySpecialAttack(){
        return $this->probabilySpecialAttack;
    }


}
class Pokemon{

    protected string $name;
    protected string $url;
    protected int $hp;

    protected AttackPokemon $attackPokemon;

    public function __construct(string $name, string $url, int $hp, AttackPokemon $attackPokemon){
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    // Getters

    public function getName(): string{
        return $this->name;
    }

    public function getUrl(): string{
        return $this->url;
    }

    public function getHP(): int{
        return $this->hp;
    }

    public function getAttackPokemon(): AttackPokemon{
        return $this->attackPokemon;
    }



    // Setters

    public function setName(string $name): void{
        $this->name = $name;
    }

    public function setUrl(string $url): void{
        $this->url = $url;
    }

    public function setHP(int $hp): void{
        $this->hp = $hp;
    }

    public function setAttackPokemon(AttackPokemon $attackPokemon): void{
        $this->attackPokemon = $attackPokemon;
    }


    //isDead
    /**
     * @return bool
     */
    public function isDead(): bool{
        return $this->hp <= 0;
    }   




    //attack
    /**
     * @param Pokemon $p
     * @return void
     */
    public function attack(Pokemon $p): void{
        $atkMin = $this->attackPokemon->getAttackMinimal();
        $atkMax = $this->attackPokemon->getAttackMaximal();
        $atk = rand($atkMin, $atkMax);
        $specialProb = $this->attackPokemon->getProbabilySpecialAttack();

        $special = rand(1, 100);
        $IsSpecial = ($special <= $specialProb) ? true : false;

        if ($IsSpecial) {
            $coef = $this->attackPokemon->getSpecialAttack();
            $atk *= $coef;
            echo "{$this->name} uses SPECIAL Attack !\n";
        } else {
            echo "{$this->name} uses normal Attack.\n";
        }

        echo "{$this->name} deals $atk damages to {$p->getName()}.\n";

        $newHp = $p->getHp() - $atk;
        $p->setHp($newHp);
    }




    //WhoAmI
    /**
     * @return void
     */
    public function whoAmI(): void {
        echo "Nom : {$this->name}\n";
        echo "Image : {$this->url}\n";
        echo "HP : {$this->hp}\n";
        echo "Attack minimal: {$this->attackPokemon->getAttackMinimal()}\n";
        echo "Attack maximal: {$this->attackPokemon->getAttackMaximal()}\n";
        echo "SpecialAttack: {$this->attackPokemon->getSpecialAttack()}\n";
        echo "ProbabilitySpecialAttack: {$this->attackPokemon->getProbabilySpecialAttack()}%\n";
    }
}


    // Script Scenario 1
    // Pokemon : Pikachu vs Charizard

    echo"Scenrio 1 : Pikachu vs Charizard\n\n";

    $pikachuAtk = new AttackPokemon(10, 20, 2, 40);
    $charizardAtk = new AttackPokemon(8, 25, 3, 25);

    $pikachu = new Pokemon("Pikachu", "https://img.pokemondb.net/artwork/pikachu.jpg", 200, $pikachuAtk);
    $charizard = new Pokemon("Charizard", "https://img.pokemondb.net/artwork/charizard.jpg", 200, $charizardAtk);

    echo ">>> POKEMON BATTLE <<<\n\n";
    $pikachu->whoAmI();
    $charizard->whoAmI();

    $round = 1;
    while (!$pikachu->isDead() && !$charizard->isDead()) {
    echo "------ Round $round ------\n";
    $pikachu->attack($charizard);

    if ($charizard->isDead()) {
        echo "{$charizard->getName()} is DEAD !\n";
        break;
    }

    $charizard->attack($pikachu);
    if ($pikachu->isDead()) {
        echo "{$pikachu->getName()} is DEAD !\n";
        break;
    }

    echo "{$pikachu->getName()} HP : {$pikachu->getHp()} | {$charizard->getName()} HP : {$charizard->getHp()}\n\n";
    $round++;
    echo "------------------------\n";
}

echo ">>> END BATTLE <<<\n\n";

if ($pikachu->isDead()) {
    echo "{$charizard->getName()} wins the battle with {$charizard->getHp()} HP left !\n";
} else {
    echo "{$pikachu->getName()} wins the battle with {$pikachu->getHp()} HP left !\n";
}

        



// PokemonFeu : Super efficace contre Plante, moins efficace contre Eau et Feu
class PokemonFeu extends Pokemon {
    public function __construct(string $name, string $url, int $hp, AttackPokemon $attackPokemon) {
        parent::__construct($name, $url, $hp, $attackPokemon);
    }

    public function attack(Pokemon $p): void {
        $atkMin = $this->attackPokemon->getAttackMinimal();
        $atkMax = $this->attackPokemon->getAttackMaximal();
        $atk = rand($atkMin, $atkMax);

        if ($p instanceof PokemonPlante) {
            // Feu > Plante
            $atk *= 2;
            echo "{$this->name} deals more damages (Feu > Plante)!\n";
        } elseif ($p instanceof PokemonEau || $p instanceof PokemonFeu) {
            // Feu < Eau ou Feu
            $atk *= 0.5;
            echo "{$this->name} deals less damages (Feu < Eau/Feu)!\n";
        }

        $specialProb = $this->attackPokemon->getProbabilySpecialAttack();
        $special = rand(1, 100);
        $IsSpecial = ($special <= $specialProb) ? true : false;

        if ($IsSpecial) {
            $coef = $this->attackPokemon->getSpecialAttack();
            $atk *= $coef;
            echo "{$this->name} uses SPECIAL Attack !\n";
        } else {
            echo "{$this->name} uses normal Attack.\n";
        }

        echo "{$this->name} deals $atk damages to {$p->getName()}.\n";

        $newHp = $p->getHp() - $atk;
        $p->setHp($newHp);
    
    }
}

// PokemonEau : Super efficace contre Feu, moins efficace contre Plante et Eau
class PokemonEau extends Pokemon {
    public function __construct(string $name, string $url, int $hp, AttackPokemon $attackPokemon) {
        parent::__construct($name, $url, $hp, $attackPokemon);
    }
    public function attack(Pokemon $p): void {
        $atkMin = $this->attackPokemon->getAttackMinimal();
        $atkMax = $this->attackPokemon->getAttackMaximal();
        $atk = rand($atkMin, $atkMax);

        if ($p instanceof PokemonFeu) {
            // Eau > Feu
            $atk *= 2;
            echo "{$this->name} deals more damages (Eau > Feu)!\n";
        } elseif ($p instanceof PokemonPlante || $p instanceof PokemonEau) {
            // Eau < Plante/Eau
            $atk *= 0.5;
            echo "{$this->name} deals less damages (Eau < Plante/Eau)!\n";
        }

        $specialProb = $this->attackPokemon->getProbabilySpecialAttack();
        $special = rand(1, 100);
        $IsSpecial = ($special <= $specialProb) ? true : false;

        if ($IsSpecial) {
            $coef = $this->attackPokemon->getSpecialAttack();
            $atk *= $coef;
            echo "{$this->name} uses SPECIAL Attack !\n";
        } else {
            echo "{$this->name} uses normal Attack.\n";
        }

        echo "{$this->name} deals $atk damages to {$p->getName()}.\n";

        $newHp = $p->getHp() - $atk;
        $p->setHp($newHp);
    
    }
}

    

// PokemonPlante : Super efficace contre Eau, moins efficace contre Feu et Plante
class PokemonPlante extends Pokemon {
    public function __construct(string $name, string $url, int $hp, AttackPokemon $attackPokemon) {
        parent::__construct($name, $url, $hp, $attackPokemon);
    }

    protected function applyTypeEffectiveness(int $atk, Pokemon $enemy): int {
        if ($enemy instanceof PokemonEau) {
            // Plante > Eau
            $atk *= 2;
            echo "{$this->name} deals more damages (Plante > Eau)!\n";
        } elseif ($enemy instanceof PokemonFeu || $enemy instanceof PokemonPlante) {
            // Plante < Feu/Plante
            $atk *= 0.5;
            echo "{$this->name} deals less damages (Plante < Feu/Plante)!\n";
        }
        return $atk;
    }
}


//Script Scenario 2
// Pokemon : Pikachu (Pokemon) vs Salameche(Pokemon Feu) vs Squirtle(Pokemon Eau)

echo"Scenrio 2 : Pikachu vs Salameche vs Squirtle\n\n";

$pikachuAtk = new AttackPokemon(10, 20, 2, 40);
$salamecheAtk = new AttackPokemon(8, 18, 2, 30);
$squirtleAtk = new AttackPokemon(8, 18, 2, 30);

$pikachu = new Pokemon("Pikachu", "https://img.pokemondb.net/artwork/pikachu.jpg", 200, $pikachuAtk);
$salameche = new PokemonFeu("Salamèche", "https://img.pokemondb.net/artwork/salameche.jpg", 200, $salamecheAtk);
$squirtle = new PokemonEau("Squirtle", "https://img.pokemondb.net/artwork/squirtle.jpg", 200, $squirtleAtk);

echo ">>> POKEMON BATTLE <<<\n\n";
$pikachu->whoAmI();
$salameche->whoAmI();
$squirtle->whoAmI();

$round = 1;
while (!$pikachu->isDead() && !$salameche->isDead() && !$squirtle->isDead()) {
    echo "------ Round $round ------\n";
    $salameche->attack($pikachu);
    if ($pikachu->isDead()) {
        echo "{$pikachu->getName()} is DEAD !\n";
        break;
    }

    $squirtle->attack($salameche);
    if ($salameche->isDead()) {
        echo "{$salameche->getName()} is DEAD !\n";
        break;
    }

    $pikachu->attack($squirtle);
    if ($squirtle->isDead()) {
        echo "{$squirtle->getName()} is DEAD !\n";
        break;
    }

    echo "{$pikachu->getName()} HP: {$pikachu->getHp()} | {$salameche->getName()} HP: {$salameche->getHp()} | {$squirtle->getName()} HP: {$squirtle->getHp()}\n\n";
    $round++;
}

echo ">>> END BATTLE <<<\n\n";

?>
