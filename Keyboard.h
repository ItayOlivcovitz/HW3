#pragma once
#include "Item.h"
#include "PeripheralDevice.h"
#include "Computer.h"
class Keyboard : public PeripheralDevice
{
	int m_numberOfKeys;

public:
	//constractor
	Keyboard(const int price, const std::string manufacturer, const std::string cpu, const bool isWireless, const int numberOfKeys);
	
	//set the number of keys in the keyboard
	void setNumberOfKeys(const int numberOfKeys);

	//return the number of keys in the keyboard
	int getNumberOfKeys() const;

	//casting operator (to string)
	operator std::string() const;

	//print to with computer the keyboard is connected to
	void connect(const Computer& computer) const override;

	//destractor
	~Keyboard();
};