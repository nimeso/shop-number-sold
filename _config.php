<?php
DataObject::add_extension("Order","OrderNumberSoldDecorator");
Object::add_extension("Product", "BuyableNumberSoldDecorator");
Object::add_extension("ProductVariation", "BuyableNumberSoldDecorator");