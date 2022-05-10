
#ifndef ITEM_H
#define ITEM_H

#include <string>
#include <iostream>

using std::string;

class Item {

private:
    static int itemCounter;

protected:
    const int id;
    int price;

    string manufacturer;

public:

    Item();

    int getId() const;

    int getPrice() const;
    void setPrice(int price);

    const string& getManufacturer() const;
    void setManufacturer(const string& manufacturer);

    // TODO : Set = 0 - for abstruct class
    virtual operator string() const;

    virtual ~Item();

};

#endif /* ITEM_H */