//Student1 Daniel Penkov, penkovdany@gmail.com, 207925504
//Student2 Itay Olivcovitz, Itay.olivcovitz@gmail.com, 207745639

#ifndef BRANCH_H
#define BRANCH_H

#include "Item.h"
#include <string>

#define STORE_SIZE 10
#define INITIAL_SIZE 0

using std::string;

class Branch 
{
private:
	// Private variables
	Item** itemCatalog;
	string location;
	int capacity;	// Not representing how much items in brunch !

	// Check the index for the next item
	int nextItemIndex () const;

	// Return how many items in the catalog
	int howManyItems () const;

public:
	/**
	 * @brief Construct a new Branch object.
	 * 
	 * @param location - location of Branch
	 */
	Branch(const string& location);

	/**
	 * @brief Add item to the branch.
	 * 
	 * @param item - item to be added
	 */
	void addItem(Item* item);

	/**
	 * @brief Get array for Item pointers inside this branch.
	 * 
	 * @param num - how much items int returned array
	 * @return Item** - array of brunch items
	 */
	Item** getCatalog(int& size);
	
	/**
	 * @brief Set the brunch location.
	 * 
	 * @param location - new location to set
	 */
	void setLocation(const string& location) ;

	/**
	 * @brief Get the brunch location
	 * 
	 * @return std::string - brunch's location
	 */
	std::string getLocation() const;

	// Destractor
	~Branch();
};

#endif /* BRANCH_H */