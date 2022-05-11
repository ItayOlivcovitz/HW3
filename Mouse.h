#pragma once
#include "Item.h"
#include "PeripheralDevice.h"

class Mouse :public PeripheralDevice
{
	int m_dpi;
public:
	//constractor
	Mouse(const int price, const std::string manufacturer, const std::string color , const bool isWireless, const int dpi);

	//set dpi
	void setDpi(const int dpi);

	//return dpi
	int getDpi() const;
	
	//casting operator (to string)
	operator std::string() const;

	//print to with computer the mouse is connected to
	void connect(const Computer& computer) const override;

	//destractor
	~Mouse();
};
