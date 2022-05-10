#include <iostream>
#include "Computer.h"
#include "Item.h"

//constractor
Computer::Computer(const int price, const std::string manufacturer, const std::string cpu, const bool isLaptop)
	:m_cpu(cpu) , m_isLaptop(isLaptop), Item(price, manufacturer)
{
	
}
//set cpu name
void Computer::setCpu(const std::string cpu)
{
	this->m_cpu = cpu;
}

//return cpu
std::string Computer::getCpu() const
{
	return this->m_cpu;
}

//set if laptop -T\F
void Computer::setIsLaptop(const bool isLaptop)
{
	this->m_isLaptop = isLaptop;
}

// return is laptop
bool Computer::getIsLaptop() const
{
	return this->m_isLaptop;
}

//casting operator (to string)
Computer::operator std::string() const
{
	std::string s_item;
	std::string s_isLaptop;
	std::string s_cpu;

	if (this->getIsLaptop() == true)
	{
		s_isLaptop = "Laptop, ";
	}
	else
	{
		s_isLaptop = "Desktop, ";
	}

	s_cpu = this->getCpu();
	s_item = Item::operator std::string();
	

	//d 1: Dell 70$, Laptop, Intel


	return s_item + s_isLaptop+ s_cpu;
}

//destractor
Computer::~Computer()
{

}
