<?php

/**
 * @charset UTF-8
 *
 * Задание 3
 * В данный момент компания X работает с двумя перевозчиками
 * 1. Почта России
 * 2. DHL
 * У каждого перевозчика своя формула расчета стоимости доставки посылки
 * Почта России до 10 кг берет 100 руб, все что cвыше 10 кг берет 1000 руб
 * DHL за каждый 1 кг берет 100 руб
 * Задача:
 * Необходимо описать архитектуру на php из методов или классов для работы с
 * перевозчиками на предмет получения стоимости доставки по каждому из указанных
 * перевозчиков, согласно данным формулам.
 * При разработке нужно учесть, что количество перевозчиков со временем может
 * возрасти. И делать расчет для новых перевозчиков будут уже другие программисты.
 * Поэтому необходимо построить архитектуру так, чтобы максимально минимизировать
 * ошибки программиста, который будет в дальнейшем делать расчет для нового
 * перевозчика, а также того, кто будет пользоваться данным архитектурным решением.
 *
 */

# Использовать данные:
# любые

abstract class Carrier {
    abstract public function calculateShippingCost($weight);
  }
  
  class RussianPost extends Carrier {
    public function calculateShippingCost($weight) {
      if ($weight <= 10) {
        return 100;
      } else {
        return 1000;
      }
    }
  }
  
  class DHL extends Carrier {
    public function calculateShippingCost($weight) {
      return $weight * 100;
    }
  }
  
  class ShippingCalculator {
    private $carrier;
  
    public function __construct(Carrier $carrier) {
      $this->carrier = $carrier;
    }
  
    public function calculateCost($weight) {
      return $this->carrier->calculateShippingCost($weight);
    }
  }
  
$russianPost = new RussianPost();
$dhl = new DHL();

$calculator1 = new ShippingCalculator($russianPost);
$cost1 = $calculator1->calculateCost(15); // стоимость доставки почтой России для посылки весом 15 кг
echo "Russian Post cost: $cost1\n";

$calculator2 = new ShippingCalculator($dhl);
$cost2 = $calculator2->calculateCost(15); // стоимость доставки DHL для посылки весом 15 кг
echo "DHL cost: $cost2\n";

