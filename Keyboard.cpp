#include <iostream>
#include "Keyboard.h"
#include "Computer.h"
#include <string>
#include "PeripheralDevice.h"

//constractor
Keyboard::Keyboard(const int price, const std::string manufacturer, const std::string color, const bool isWireless, int numberOfKeys)
	: PeripheralDevice(color, isWireless,price,manufacturer), m_numberOfKeys(numberOfKeys)
{
}

 //set the number of keys in the keyboard
void Keyboard::setNumberOfKeys(const int numberOfKeys)
{
	this->m_numberOfKeys = numberOfKeys;
}

//return the number of keys in the keyboard
int Keyboard::getNumberOfKeys() const
{
	return this->m_numberOfKeys;
}

//casting operator (to string)
Keyboard::operator std::string() const
{
	std::string s_item;
	std::string s_isWireless;
	std::string s_color;
	std::string s_keyboard;

	
	if (this->getIsWireless() == true)
	{
		s_isWireless = "Wireless, ";
	}
	else
	{
		s_isWireless = "Wired, ";
	}

	s_item     = Item::operator std::string();
	s_color    = this->getColor() + ", ";
	s_keyboard = "Keyboard with " + std::to_string(this->getNumberOfKeys()) + " keys";
	
	
	
	//id 4: Casio 10$, Wired, Silver, Keyboard with 26 keys
	return s_item + s_isWireless + s_color + s_keyboard;
}

//print to with computer the keyboard is connected to
void Keyboard::connect(const Computer & computer) const
{
	std::string s_connecting_item;
	std::string s_keyboard_info;
	std::string s_computer_info;

	s_connecting_item = "Connecting a keyboard";
	std::cout << s_connecting_item << std::endl;

	s_keyboard_info = std::string(*this);
	s_computer_info = std::string(computer);
	std::cout << s_keyboard_info <<" is Connecting to computer: "<< s_computer_info << std::endl;
}

//destractor
Keyboard::~Keyboard()
{

}
