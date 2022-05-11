#include "Mouse.h"
#include "Computer.h"
#include <string>
#include "PeripheralDevice.h"

//constractor
Mouse::Mouse(const int price, const std::string manufacturer, const std::string color, const bool isWireless, const int dpi)
	:m_dpi(dpi), PeripheralDevice(color, isWireless,price,manufacturer)
{
	
}

//set dpi
void Mouse::setDpi(const int dpi)
{
	this->m_dpi = dpi;
}

//return dpi
int Mouse::getDpi() const
{
	return this->m_dpi;
}

//casting operator (to string)
Mouse::operator std::string() const
{
	std::string s_item;
	std::string s_isWireless;
    std::string s_color  ;
	std::string s_dpi;

	if (this->getIsWireless() == true)
	{
		s_isWireless = "Wireless, ";
	}
	else
	{
		s_isWireless = "Wired, ";
	}
	s_item = Item::operator std::string();
	s_color = this->getColor() + ", ";
	s_dpi   = "Mouse with dpi : " + std::to_string(this->getDpi());
	//id 3: Pilot 5$, Wireless, Red, Mouse with dpi : 100


	return s_item + s_isWireless + s_color + s_dpi;
}

//print to with computer the mouse is connected to
void Mouse::connect(const Computer& computer) const
{
	std::string s_connecting_item;
	std::string s_mouse_info;
	std::string s_computer_info;

	s_connecting_item = "Connecting a mouse";
	std::cout << s_connecting_item << std::endl;

	s_mouse_info = std::string(*this);
	s_computer_info = std::string(computer);
	std::cout << s_mouse_info << " is Connecting to computer: " << s_computer_info << std::endl;

}

//destractor
Mouse::~Mouse()
{
	
}
  
