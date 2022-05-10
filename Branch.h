#pragma once
#include "Item.h"
#define STORE_SIZE 10
class Branch 
{
	Item** m_item_Catalog;
	std::string m_location;
	int m_capacity;

	//check the index for the next item
	int store();

	// return how many items in the catalog
	int howManyItems()const ;

public:
	//constractor
	Branch(std::string location);

	//addItem to Item catalog
	void addItem( Item * item);

	//return item catalog
	Item** getCatalog(int & num) ;
	
	//set location
	void setLocation(const std::string location) ;

	//return location
	std::string getLocation() const;

	//destractor
	~Branch();

};