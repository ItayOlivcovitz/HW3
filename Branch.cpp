//Student1 Daniel Penkov, penkovdany@gmail.com, 207925504
//Student2 Itay Olivcovitz, Itay.olivcovitz@gmail.com, 207745639

#include "Branch.h"

/**
 * @brief Construct a new Branch object
 * 
 * @param location of Branch
 */
Branch::Branch(const string& location)
	: location(location), capacity(INITIAL_SIZE)
{
	// Allocate array to store the items
	this->itemCatalog = new Item* [STORE_SIZE];
}

// Check the index for the next item
int Branch::nextItemIndex() const
{
	if (this->capacity >= STORE_SIZE)
	{
		// In Case more items added then branch can store
		delete this->itemCatalog[capacity % STORE_SIZE];
		return capacity % STORE_SIZE;
	}

	return this->capacity;
} 

// Return how many items in the catalog
int Branch::howManyItems() const
{
	// Capacity stores how many items added - not how many are stored
	if (this->capacity >= STORE_SIZE)
	{
		return STORE_SIZE;
	}
	
	return this->capacity;
}

/**
 * @brief Add item to the branch.
 * 
 * @param item - item to be added
 */
void Branch::addItem(Item* item)
{
	// Stores item
	this->itemCatalog[nextItemIndex()] = item;
	this->capacity++;
}

/**
 * @brief Get array for Item pointers inside this branch.
 * 
 * @param num - how much items int returned array
 * @return Item** - array of brunch items
 */
Item** Branch::getCatalog(int &size)  
{
	// Checge 'size' in calling method
	size = howManyItems();
	return this->itemCatalog;
}

/**
 * @brief Set the brunch location.
 * 
 * @param location - new location to set
 */
void Branch::setLocation(const string& location)
{
	this->location = location;
}

/**
 * @brief Get the brunch location
 * 
 * @return std::string - brunch's location
 */
std::string Branch::getLocation() const
{
	return this->location;
}

// Destractor
Branch::~Branch()
{
	int length = howManyItems();
	
	// Free items iside branch
	for (int i = 0; i < length; i++)
	{
		delete this->itemCatalog[i];
	}
}
