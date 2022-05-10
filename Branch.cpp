#include <iostream>
#include "Branch.h"
#include "Item.h"

//constractor
Branch::Branch(std::string location)
	: m_location(location),m_capacity(0)
{
	this->m_item_Catalog = new Item * [STORE_SIZE];
}

//check the index for the next item
int Branch:: store() 
{
	if (this->m_capacity >= STORE_SIZE)
	{
		delete this->m_item_Catalog[m_capacity % 10];
		return m_capacity % 10;

	}
	return this->m_capacity;
} 

//return how many items in the catalog
int Branch:: howManyItems()const
{
	if (this->m_capacity >= STORE_SIZE)
	{
		return STORE_SIZE;
	}
	return this->m_capacity;
}

// add item to the catalog
void Branch::addItem( Item* item)
{
	int index = store();
	this->m_item_Catalog[index] = item;
	this->m_capacity++;
}

// return the catalog
Item** Branch::getCatalog(int &num)  
{
	num = howManyItems();
	return this->m_item_Catalog;
}

//set location
void Branch::setLocation(const std::string location)
{
	this->m_location = location;
}
//return location
std::string Branch::getLocation() const
{
	return this->m_location;
}

//destractor
Branch::~Branch()
{
	int length = howManyItems();
	for (int i = 0; i < length; i++)
	{
		delete this->m_item_Catalog[i];
	}
}
