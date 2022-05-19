//Student1 Daniel Penkov, penkovdany@gmail.com, 207925504
//Student2 Itay Olivcovitz, Itay.olivcovitz@gmail.com, 207745639

#include "Item.h"

// Starts ids from 1
int Item::nextItemId = FIRST_ID;

/**
 * @brief Construct a new Item object.
 * 
 * @param price - Item's price
 * @param manufacturer - Item's manufacturer
 */
Item::Item(int price, const string& manufacturer)
    : id(nextItemId++) ,price(price), manufacturer(manufacturer)
{}


/**
 * @brief Get item's ID.
 * 
 * @return int - ID
 */
int Item::getId () const
{
    return this->id;
}

/**
 * @brief Get item's price.
 * 
 * @return int - item's price
 */
int Item::getPrice() const
{
    return this->price;
}

/**
 * @brief Set item's price.
 * 
 * @param price - new item's price
 */
void Item::setPrice(int price)
{
    this->price = price;
}

/**
 * @brief Get item's manufacturer.
 * 
 * @return return item's manufacturer
 */
string Item::getManufacturer() const
{
    return this->manufacturer;
}

/**
 * @brief Set item's manufacturer.
 * 
 * @param manufacturer - string representing the manufacturer
 */
void Item::setManufacturer(const string& manufacturer)
{
    this->manufacturer = manufacturer;
}

/**
 * @brief Return string representing the item.
 * 
 * @return string
 */
Item::operator string() const
{
    string s_id = "id " + to_string (this->id);
    string s_price = std::to_string (this->price) + "$";

    return s_id + ": " + this->manufacturer + " " + s_price;
}

// Destructor
Item::~Item ()
{
    std::cout << "Throwing away an item" << std::endl;
}