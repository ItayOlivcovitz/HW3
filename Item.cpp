
#include "Item.h"

int Item::itemCounter = 0;

Item::Item() : id(++itemCounter) ,price(0) { }

// new constractor
Item::Item(int price, std::string manufacturer)
    : id(++itemCounter) ,price(price), manufacturer(manufacturer)
{

}

int Item::getId () const
{
    return this->id;
}

int Item::getPrice() const
{
    return this->price;
}

void Item::setPrice(int price)
{
    this->price = price;
}

const string& Item::getManufacturer() const
{
    return this->manufacturer;
}

void Item::setManufacturer(const string& manufacturer)
{
    this->manufacturer = manufacturer;
}

Item::operator string() const
{
    return "id " + std::to_string (this->id) + ": "
            + this->manufacturer + ", "
            + std::to_string (this->price) + "$";
}

Item::~Item ()
{
    std::cout << "Throwing away an item" << std::endl;
}