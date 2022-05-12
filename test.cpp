/*
HW3 test written by Omer R
Pushed 12.05.2022
*/


#include <iostream>
#include "Branch.h"
#include "Computer.h"
#include "Mouse.h"
#include "Keyboard.h"
#define TEST_MAIN_SIZE 9 // not related to STORE_SIZE , only here for the main test

/* FOREGROUND */
#define RST  "\x1B[0m"
#define KRED  "\x1B[31m"
#define KGRN  "\x1B[32m"
#define KYEL  "\x1B[33m"
#define KBLU  "\x1B[34m"
#define KMAG  "\x1B[35m"
#define KCYN  "\x1B[36m"
#define KWHT  "\x1B[37m"

#define FRED(x) KRED x RST
#define FGRN(x) KGRN x RST
#define FYEL(x) KYEL x RST
#define FBLU(x) KBLU x RST
#define FMAG(x) KMAG x RST
#define FCYN(x) KCYN x RST
#define FWHT(x) KWHT x RST
#define BOLD(x) "\x1B[1m" x RST // BOLD
#define UNDL(x) "\x1B[4m" x RST // UNDERLINE
#define RESETTEXT  "\x1B[0m" // Set all colors back to normal.

/* BACKGROUND */
// These codes set the background color behind the text.
#define BACKBLK "\x1B[40m"
#define BACKRED "\x1B[41m"
#define BACKGRN "\x1B[42m"
#define BACKYEL "\x1B[43m"
#define BACKBLU "\x1B[44m"
#define BACKMAG "\x1B[45m"
#define BACKCYN "\x1B[46m"
#define BACKWHT "\x1B[47m"
// These will set the text's background color then reset it back.
#define BackBLK(x) BACKBLK x RESETTEXT
#define BackRED(x) BACKRED x RESETTEXT
#define BackGRN(x) BACKGRN x RESETTEXT
#define BackYEL(x) BACKYEL x RESETTEXT
#define BackBLU(x) BACKBLU x RESETTEXT
#define BackMAG(x) BACKMAG x RESETTEXT
#define BackCYN(x) BACKCYN x RESETTEXT
#define BackWHT(x) BACKWHT x RESETTEXT

void print_branch_catalog(Branch& branch)
{
	int num;
	Item** catalog = branch.getCatalog(num);
	std::cout << "Printing KSF branch in " << branch.getLocation() << std::endl;
	std::cout << "There are " << num << " item in the catalog" << std::endl;
	for (int i = 0; i < num; i++)
	{
		//std::cout << "index: " << i <<" " << std::string(*catalog[i]) << std::endl;
		std::cout << "index : "<<i<<"  " << std::string(*catalog[i]) << std::endl;
	}
}


int test_catalog_output(Branch& branch)
{
	int num;
	Item** catalog = branch.getCatalog(num);
	int res = 0;
	res += std::string(*catalog[0]).compare("id 2: item4, 100$ , Desktop, AMD");
	res += std::string(*catalog[1]).compare("id 8: item5, 5$ , Wireless, Red, Mouse with dpi : 100");
	res+= std::string(*catalog[2]).compare("id 6: item6, 10$ , Wired, Silver, Keyboard with 26 keys");
	res+= std::string(*catalog[3]).compare("id 4: item7, 100$ , Desktop, AMD");
	res+= std::string(*catalog[4]).compare("id 9: item8, 5$ , Wireless, Red, Mouse with dpi : 100");
	res+= std::string(*catalog[5]).compare("id 14: onemore, 100$ , Desktop, AMD");
	return res;
	
}


int main()
{

	// test if you allowed main to define "STORE_SIZE"
	std::cout << BackYEL(UNDL(FBLU("test if you allowed main to define STORE_SIZE"))) << std::endl;
#ifdef STORE_SIZE
	std::cout << "You shouldn't define STORE_SIZE on your code." << std::endl;
#endif // 
#ifndef STORE_SIZE
	cout << BOLD(FGRN("You shouldn't define STORE_SIZE on your code." ))<< endl;
#endif
	#define STORE_SIZE 6

	// create a few test items
	std::cout << BackYEL(UNDL(FBLU("create a few test items"))) << std::endl;

	//freopen("Omer_test_output.txt", "w", stdout);
	Item* items[TEST_MAIN_SIZE]; //the array is only here for code organization

	std::cout << BackYEL(UNDL(FBLU("create computers"))) << std::endl;
	items[0] = new Computer(60, "item0", "Intel", true);
	items[4] = new Computer(100, "item4", "AMD", false);
	items[1] = new Computer(100, "item1", "AMD", false);
	items[7] = new Computer(100, "item7", "AMD", false);
	std::cout << BackYEL(UNDL(FBLU("create keyboards"))) << std::endl;
	items[3] = new Keyboard(10, "item3", "Silver", false, 26);	
	items[6] = new Keyboard(10, "item6", "Silver", false, 26);
	std::cout << BackYEL(UNDL(FBLU("create Mices"))) << std::endl;
	items[2] = new Mouse(5, "item2", "Red", true, 100);
	items[5] = new Mouse(5, "item5", "Red", true, 100);
	items[8] = new Mouse(5, "item8", "Red", true, 100);
	
	std::cout << BackYEL(UNDL(FBLU("create branch"))) << std::endl;
	Branch haifaBranch("Haifa");

	std::cout << BackWHT(UNDL(FBLU("getters are tested implicitly using the prints and other methids"))) << std::endl;

	std::cout << BackYEL(UNDL(FBLU("test setters")) )<< std::endl;
	std::cout << BackYEL(UNDL(FBLU("test set price")) )<< std::endl;
	items[0]->setPrice(70);
	items[0]->setManufacturer("Felix");
	std::cout << BackYEL(UNDL(FBLU("test branch set location"))) << std::endl;
	haifaBranch.setLocation("Oscar place");

	Mouse test_mouse(5, "test_mouse", "Red", true, 100);
	Keyboard test_keyboard(10, "test_keyboard", "Silver", false, 26);

	std::cout << BackYEL(UNDL(FBLU("test PeripheralDevice setIsWireless")) )<< std::endl;
	test_mouse.setIsWireless(false);
	std::cout << BackYEL(UNDL(FBLU("test PeripheralDevice setColor"))) << std::endl;
	test_mouse.setColor("Orange");
	std::cout << BackYEL(UNDL(FBLU("test Mouse seDpi"))) << std::endl;
	test_mouse.setDpi(123);
	// check results
	std::cout << BackYEL(UNDL(FBLU("test keyboard setNumOfKeys"))) << std::endl;
	test_keyboard.setNumberOfKeys(123);
	// check results
	if (test_mouse.getIsWireless() != false) { std::cout << FYEL("ERROR:  getIsWireless failed") << std::endl; }
	if (test_mouse.getColor() != "Orange") { std::cout << FYEL("ERROR:  getColor failed") << std::endl; }
	if (test_mouse.getDpi() != 123) { std::cout << FYEL("ERROR:  getDpi failed") << std::endl; }
	if (test_keyboard.getNumberOfKeys() != 123) { std::cout << FYEL("ERROR:  getNumOfKeys failed") << std::endl; }
	else { std::cout << BOLD(FGRN("test succeeded")) << std::endl; }




	// test if same id can show twice
	std::cout << BackYEL(UNDL(FBLU("test if same id can show twice"))) << std::endl;
	Mouse* dup_mouse = new Mouse(5, "dup_mouse", "Red", true, 100);
	int dup_mouse1_id = dup_mouse->getID();
	delete dup_mouse;
	Mouse* dup_mouse2 = new Mouse(5, "dup_mouse", "Red", true, 100);
	int dup_mouse2_id = dup_mouse2->getID();

	if (dup_mouse1_id == dup_mouse2_id) {
		std::cout << FYEL("ERROR:  IDs are not unique.") << std::endl;
	}
	else { std::cout << BOLD(FGRN("test succeeded")) << std::endl; }



	// test assertion of more than STORE_SIZE number of items
	std::cout << BackYEL(UNDL(FBLU("test assertion of more than STORE_SIZE number of items"))) << std::endl;

	for (int i = 0; i < TEST_MAIN_SIZE; i++)
	{
		haifaBranch.addItem(items[i]);
		haifaBranch.howManyItems();
		if (haifaBranch.howManyItems() > STORE_SIZE) {
			std::cout << FYEL("ERROR:  branch num items failure, probably not reducing counter when releasing items") << std::endl;
		}
	}
	
	Item* onemore = new Computer(100, "onemore", "AMD", false);
	std::cout << "add one more" << std::endl;
	haifaBranch.addItem(onemore);
	print_branch_catalog(haifaBranch);

	// test branch output
	std::cout << BackYEL(UNDL(FBLU("test branch output"))) << std::endl;
	int res = test_catalog_output(haifaBranch);
	if (res != 0) {
		std::cout << FYEL("ERROR:  branch catalog output doesn't match. There are ")<<res<< " missmatched output items." << std::endl;

	}
	else { std::cout << BOLD(FGRN("test succeeded")) << std::endl; }
	std::cout << BackYEL(UNDL(FBLU("test 'connect' function response"))) << std::endl;

	Keyboard* keyboardPtr = new Keyboard(20, "Sasio", "Gold", true, 24);
	Mouse* mousePtr = new Mouse(10, "Goldline", "White", false, 1000);
	Computer* computerPtr = new Computer(120, "Maple", "AMD", true);
	keyboardPtr->connect(*computerPtr);
	mousePtr->connect(*computerPtr);
	// test d'tor
	std::cout << BackYEL(UNDL(FBLU("test peripheral devices d'tor"))) << std::endl;
	delete mousePtr;
	delete keyboardPtr;
	delete computerPtr;
	test_mouse.~Mouse();
	test_keyboard.~Keyboard();
	delete dup_mouse2;

	std::cout << BackWHT(FMAG("test yourself for valid 'connect' function")) << std::endl;
	std::cout << BackWHT( FMAG("test yourself for valid d'tor 'throwing' function")) << std::endl;
	std::cout << BackYEL(UNDL(FBLU("test branch d'tor"))) << std::endl;
	haifaBranch.~Branch();
	std::cout << BackGRN(FMAG("END OF TEST")) << std::endl;

}