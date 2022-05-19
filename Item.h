//Student1 Daniel Penkov, penkovdany@gmail.com, 207925504
//Student2 Itay Olivcovitz, Itay.olivcovitz@gmail.com, 207745639

#ifndef ITEM_H
#define ITEM_H

#include <string>
#include <iostream>

#define FIRST_ID 1

using std::string;
using std::to_string;

class Item
{
private:
    // the next ID to give to new item
    static int nextItemId;

protected:
    const int id;
    int price;

    string manufacturer;

public:
    
    /**
     * @brief Construct a new Item object.
     * 
     * @param price - Item's price
     * @param manufacturer - Item's manufacturer
     */
    Item(const int price, const string& manufacturer);

    /**
     * @brief Get item's ID.
     * 
     * @return int - ID
     */
    int getId() const;

    /**
     * @brief Get item's price.
     * 
     * @return int - item's price
     */
    int getPrice() const;

    /**
     * @brief Set item's price.
     * 
     * @param price - new item's price
     */
    void setPrice(const int price);

    /**
     * @brief Get item's manufacturer.
     * 
     * @return return item's manufacturer
     */
    string getManufacturer() const;

    /**
     * @brief Set item's manufacturer.
     * 
     * @param manufacturer - string representing the manufacturer
     */
    void setManufacturer(const string& manufacturer);

    /**
     * @brief Return string representing the item.
     * 
     * @return string
     */
    virtual operator string() const = 0;

    // Destructor
    virtual ~Item();
};

#endif /* ITEM_H */