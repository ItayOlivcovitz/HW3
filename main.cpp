#include <iostream>
#include "Branch.h"
#include "Computer.h"
#include "Mouse.h"
#include "Keyboard.h"

#define TEST_MAIN_SIZE 4 // not related to STORE_SIZE , only here for the main test

void print_branch_catalog(Branch& branch)
{
	int num;
	Item** catalog = branch.getCatalog(num);
	std::cout << "Printing KSF branch in " << branch.getLocation() << std::endl;
	std::cout << "There are " << num << " item in the catalog" << std::endl;
	for (int i = 0; i < num; i++)
	{
		std::cout << std::string(*catalog[i]) << std::endl;
	}
}

int main()
{
	freopen("output_main.txt", "w", stdout);
	Item* items[TEST_MAIN_SIZE]; //the array is only here for code organization
	items[0] = new Computer(60, "Dell", "Intel", true);
	items[0]->setPrice(70);
	items[1] = new Computer(100, "Apple", "AMD", false);
	items[2] = new Mouse(5, "Pilot", "Red",true, 100);
	items[3] = new Keyboard(10, "Casio", "Silver", false, 26);

	Branch haifaBranch("Haifa");
	for (int i = 0; i < TEST_MAIN_SIZE; i++)
	{
		haifaBranch.addItem(items[i]);
	}
	print_branch_catalog(haifaBranch);


	PeripheralDevice* keyboardPtr = new Keyboard(20, "Sasio", "Gold", true, 24);
	PeripheralDevice* mousePtr = new Mouse(10, "Goldline", "White", false, 1000);
	Computer* computerPtr = new Computer(120, "Maple", "AMD", true);
	keyboardPtr->connect(*computerPtr);
	mousePtr->connect(*computerPtr);

	Branch telAvivBranch("Tel Aviv");
	telAvivBranch.setLocation(telAvivBranch.getLocation() + "-Yafo");
	telAvivBranch.addItem(keyboardPtr);
	telAvivBranch.addItem(computerPtr);
	print_branch_catalog(telAvivBranch);

	delete mousePtr;
}

