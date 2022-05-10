

#include "Item.h"
#include "Branch.h"

#include <iostream>

int main()
{
    Item* item = new Item();

    item->setPrice(100);
    item->setManufacturer("Evil Corp.");

    std::cout << "Hello world !" << std::endl;
    std::cout << string(*item) << std::endl;

    delete item;
}